<?php

namespace App\Service\Trick;

use App\Repository\UserRepository;
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
     * @var UserRepository
     */
    private $userRepository;
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
    private $saveVideoTrick;


    public function __construct(EntityManagerInterface $manager,
                                UserRepository $userRepository,
                                SluggerInterface $slugger,
                                SaveImage $saveImage,
                                UploadImage $uploadImage,
                                SaveVideoTrick $saveVideoTrick)
    {
        $this->manager = $manager;
        $this->userRepository = $userRepository;
        $this->slugger = $slugger;
        $this->saveImage = $saveImage;
        $this->uploadImage = $uploadImage;
        $this->saveVideoTrick = $saveVideoTrick;
    }


    public function saveTrick($formTrick, $user)
    {
        $trick = $formTrick->getData();

        $images = $formTrick->get("images")->getData();
        $videos = $formTrick->get("videos")->getData();
//        dd($images);
//        for ($i=0; $i<=count($images);$i++)
//        {
//            $fileName = $this->uploadImage->saveImage($images[$i]);
//        }
        foreach ($images as $image){
            dump($image);
            $fileName = $this->uploadImage->saveImage($image);
        }
        $this->saveImage->saveOnTrick($fileName, $trick);

        $this->saveVideoTrick->saveOnTrick($videos,$trick);

        $slug = $this->slugger->slug($trick->getName());
        $trick->setSlug($slug);


        $trick->setUser($user);
        if ($trick->getCreatedAt()) {
            $trick->setUpdatedAt(new DateTime());
        } else {
            $trick->setCreatedAt(new DateTime());
        }
        $this->manager->persist($trick);
        $this->manager->flush();

        return $trick;
    }
}