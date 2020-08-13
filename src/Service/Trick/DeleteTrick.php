<?php


namespace App\Service\Trick;


use App\Service\Upload\SaveImage;
use Doctrine\ORM\EntityManagerInterface;

class DeleteTrick
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;
    /**
     * @var SaveImage
     */
    private $saveImage;

    public function __construct(EntityManagerInterface $entityManager,SaveImage $saveImage)
    {
        $this->entityManager = $entityManager;
        $this->saveImage = $saveImage;
    }

    public function delete($trick)
    {
        $images = $trick->getImages();
        foreach ($images as $image){
            $this->saveImage->deleteImageInServer($image);
            $this->entityManager->remove($image);
        }
        $videos = $trick->getVideos();
        foreach ($videos as $video){
            $this->entityManager->remove($video);
        }

        $this->entityManager->remove($trick);
        $this->entityManager->flush();
    }
}