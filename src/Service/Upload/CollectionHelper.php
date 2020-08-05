<?php


namespace App\Service\Upload;


use App\Entity\Image;
use App\Entity\Trick;
use Doctrine\Common\Collections\ArrayCollection;

class CollectionHelper
{
    /**
     * @var SaveImage
     */
    private $saveImage;

    public function __construct(SaveImage $saveImage)
    {
        $this->saveImage = $saveImage;
    }

    public function addOldImage(Trick $trick)
    {
        $originalImages = new ArrayCollection();
        foreach ($trick->getImages() as $image) {
            $originalImages->add($image);
        }
        return $originalImages;
    }

    public function removeOld(Trick $trick, ArrayCollection $images, ArrayCollection $videos)
    {
        foreach ($images as $image) {
            if (false === $trick->getImages()->contains($image)) {
                $trick->removeImage($image);
            }
        }
        foreach ($videos as $video) {
            if (false === $trick->getVideos()->contains($video)) {
                $trick->removeVideo($video);
            }
        }
    }

    public function addOldVideo(Trick $trick)
    {
        $originalVideos = new ArrayCollection();
        foreach ($trick->getVideos() as $video) {
            $originalVideos->add($video);
        }
        return $originalVideos;
    }
}