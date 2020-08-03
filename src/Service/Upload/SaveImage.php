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

            $this->deleteImage($oldImage);
        }
        $image->setUser($user);
        $this->manager->persist($image);
        $this->manager->flush();
    }


    public function deleteImage(Image $image)
    {
        $image->setUser(null);
        unlink($this->imageDirectory . '/' . $image->getFileName());
        $this->manager->remove($image);
        $this->manager->flush();
    }

    public function saveOnTrick(Trick $trick, Image $image)
    {
        $this->manager->persist($image);
    }

}