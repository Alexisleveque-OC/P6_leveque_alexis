<?php


namespace App\Service\Upload;


use App\Entity\Image;
use App\Entity\Trick;
use App\Repository\ImageRepository;
use Doctrine\ORM\EntityManagerInterface;

class SaveImage
{
    /**
     * @var EntityManagerInterface
     */
    private $manager;
    /**
     * @var ImageRepository
     */
    private $imageRepository;
    /**
     * @var string $imageDirectory
     */
    private $imageDirectory;

    /**
     * SaveImage constructor.
     * @param EntityManagerInterface $manager
     * @param ImageRepository $imageRepository
     * @param string $imageDirectory
     */
    public function __construct(EntityManagerInterface $manager, ImageRepository $imageRepository, string $imageDirectory)
    {
        $this->manager = $manager;
        $this->imageRepository = $imageRepository;
        $this->imageDirectory = $imageDirectory;
    }

    public function saveOnUser(Image $image, $user)
    {
        if ($oldImage = $user->getImage()) {
            $this->deleteImageInServer($oldImage);
            $this->manager->remove($oldImage);
            $this->manager->flush();
        }
        $image->setUser($user);
        $this->manager->persist($image);
        $this->manager->flush();
    }


    public function deleteImageInServer(Image $image)
    {
        $image->setUser(null);
        $image->setTrick(null);
        try {
            unlink($this->imageDirectory . '/' . $image->getFileName());
        } finally {
            return true;
        }
    }
}