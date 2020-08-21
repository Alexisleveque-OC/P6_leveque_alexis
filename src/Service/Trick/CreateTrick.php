<?php

namespace App\Service\Trick;

use App\Service\Upload\SaveImage;
use App\Service\Upload\SaveVideoTrick;
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
    /**
     * @var SaveVideoTrick
     */
    private $saveVideo;


    public function __construct(EntityManagerInterface $manager,
                                SluggerInterface $slugger,
                                SaveImage $saveImage,
                                SaveVideoTrick $saveVideo,
                                UploadImage $uploadImage)
    {
        $this->manager = $manager;
        $this->slugger = $slugger;
        $this->saveImage = $saveImage;
        $this->uploadImage = $uploadImage;
        $this->saveVideo = $saveVideo;
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
            $this->saveVideo->saveOnTrick($video);
        }

        $this->manager->flush();

        return $trick;
    }
}