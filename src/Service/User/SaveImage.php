<?php


namespace App\Service\User;


use App\Entity\Image;
use Doctrine\ORM\EntityManagerInterface;

class SaveImage
{
    /**
     * @var EntityManagerInterface
     */
    private $manager;

    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    public function saveOnUser($fileName, $user)
    {
        $image = new Image();
        $image->setUser($user);
        $image->setFileName($fileName);
        $image->setUrl('/image/'.$fileName);

        $this->manager->persist($image);
        $this->manager->flush();

    }

}