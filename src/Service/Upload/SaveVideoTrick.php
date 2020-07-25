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

    public function saveOnTrick($url, $trick)
    {
        $video = new Video();

        $video->setUrl($url);
        $video->setTrick($trick);

        $this->manager->persist($video);
        $this->manager->flush();
    }
}