<?php


namespace App\Tests\Entity;

use App\Entity\Image;
use App\Entity\Trick;
use App\Entity\User;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\File\File;

class ImageTest extends TestCase
{
    public function testImageGetTrick()
    {
        $image = new Image();
        $trick = $this->createMock(Trick::class);
        $image->setTrick($trick);

        $test = $image->getTrick();

        $this->assertInstanceOf(Trick::class, $test);
    }

    public function testImageSetTrick()
    {
        $image = new Image();
        $trick = $this->createMock(Trick::class);
        $test = $image->setTrick($trick);

        $this->assertInstanceOf(Image::class, $test);
    }
    public function testImageGetUser()
    {
        $image = new Image();
        $user = $this->createMock(User::class);
        $image->setUser($user);

        $test = $image->getUser();

        $this->assertInstanceOf(User::class, $test);
    }

    public function testImageSetUser()
    {
        $image = new Image();
        $user = $this->createMock(User::class);
        $test = $image->setUser($user);

        $this->assertInstanceOf(Image::class, $test);
    }

    public function testImageGetFileName()
    {
        $image = new Image();
        $image->setFileName('coucou');

        $test = $image->getFileName();

        $this->assertSame('coucou', $test);
    }

    public function testImageSetFileName()
    {
        $image = new Image();
        $test = $image->setFileName('coucou');

        $this->assertInstanceOf(Image::class, $test);
    }

    public function testImageGetUrl()
    {
        $image = new Image();
        $image->setFileName('coucou');

        $test = $image->getUrl();

        $this->assertSame('/image/coucou', $test);
    }
    public function testImageGetFile()
    {
        $image = new Image();
        $file = $this->createMock(File::class);
        $image->setFile($file);

        $test = $image->getFile();

        $this->assertInstanceOf(File::class, $test);
    }

    public function testImageSetFile()
    {
        $image = new Image();
        $file = $this->createMock(File::class);
        $test = $image->setFile($file);

        $this->assertInstanceOf(Image::class, $test);
    }
}