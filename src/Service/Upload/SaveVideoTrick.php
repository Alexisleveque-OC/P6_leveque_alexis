<?php


namespace App\Service\Upload;


use App\Entity\Video;
use Doctrine\ORM\EntityManagerInterface;

class SaveVideoTrick
{
    /**
     * @var EntityManagerInterface
     */
    private $manager;

    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    public function saveOnTrick($iFrame, $trick)
    {
        $video = new Video();

        $video->setIFrame($iFrame);
        $video->setTrick($trick);

        $this->manager->persist($video);
    }
}