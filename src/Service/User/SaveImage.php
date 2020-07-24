<?php


namespace App\Service\User;


use App\Entity\Image;
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

    public function __construct(EntityManagerInterface $manager, ImageRepository $imageRepository)
    {
        $this->manager = $manager;
        $this->imageRepository = $imageRepository;
    }

    public function saveOnUser($fileName, $user)
    {
        $image = new Image();
        if($user->getImage()){
            $user->setImage(null);
            $image = $this->imageRepository->findOneBy(['user' => $user->getId()]);
            $image->setUser(null);
            $this->manager->remove($image);
            $this->manager->flush();
        }
        $image->setUser($user);
        $image->setFileName($fileName);
        $image->setUrl('/image/'.$fileName);

        $this->manager->persist($image);
        $this->manager->flush();

    }

}