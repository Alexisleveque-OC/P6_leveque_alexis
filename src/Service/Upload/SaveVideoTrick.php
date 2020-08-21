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

    public function saveOnTrick(Video $video)
    {
        $link = $video->getIFrame();
        $link = str_replace('youtu.be','youtube.com/embed',$link);
        $link = str_replace('dai.ly','dailymotion.com/embed/video',$link);
        $video->setIFrame($link);

        $this->manager->persist($video);
    }
}