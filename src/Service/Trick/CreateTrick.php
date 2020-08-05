<?php

namespace App\Service\Trick;

use App\Service\Upload\SaveImage;
use App\Service\Upload\UploadImage;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\String\Slugger\AsciiSlugger;
use Symfony\Component\String\Slugger\SluggerInterface;

class CreateTrick
{
    /**
     * @var EntityManagerInterface
     */
    private $manager;
    /**
     * @var AsciiSlugger
     */
    private $slugger;
    /**
     * @var SaveImage
     */
    private $saveImage;
    /**
     * @var UploadImage
     */
    private $uploadImage;


    public function __construct(EntityManagerInterface $manager,
                                SluggerInterface $slugger,
                                SaveImage $saveImage,
                                UploadImage $uploadImage)
    {
        $this->manager = $manager;
        $this->slugger = $slugger;
        $this->saveImage = $saveImage;
        $this->uploadImage = $uploadImage;
    }


    public function saveTrick($formTrick, $user)
    {

        $trick = $formTrick->getData();
        $slug = $this->slugger->slug($trick->getName());
        $trick->setSlug($slug);


        $trick->setUser($user);
        if ($trick->getCreatedAt()) {
            $trick->setUpdatedAt(new DateTime());
        } else {
            $trick->setCreatedAt(new DateTime());
        }
        $this->manager->persist($trick);

        foreach ($formTrick->get("images")->getData() as $image){
            $image = $this->uploadImage->saveImageInServer($image);
            $image->setTrick($trick);
            $this->manager->persist($image);
        }
        foreach ($formTrick->get("videos")->getData() as $video){
            $this->manager->persist($video);
        }

        $this->manager->flush();

        return $trick;
    }
}