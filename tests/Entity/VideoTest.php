<?php


namespace App\Tests\Entity;


use App\Entity\Trick;
use App\Entity\Video;
use PHPUnit\Framework\TestCase;

class VideoTest extends TestCase
{
    public function testVideoGetTrick()
    {
        $video = new Video();
        $trick = $this->createMock(Trick::class);
        $video->setTrick($trick);

        $test = $video->getTrick();

        $this->assertInstanceOf(Trick::class, $test);
    }

    public function testVideoSetTrick()
    {
        $video = new Video();
        $trick = $this->createMock(Trick::class);
        $test = $video->setTrick($trick);

        $this->assertInstanceOf(Video::class, $test);
    }

    public function testVideoGetIFrame()
    {
        $video = new Video();

        $video->setIFrame('coucou');

        $test = $video->getIFrame();

        $this->assertSame('coucou', $test);
    }

    public function testVideoSetIFrame()
    {
        $video = new Video();
        $test = $video->setIFrame('coucou');

        $this->assertInstanceOf(Video::class, $test);
    }


}