<?php


namespace App\Tests\Entity;


use App\Entity\Comment;
use App\Entity\Group;
use App\Entity\Image;
use App\Entity\Trick;
use App\Entity\User;
use App\Entity\Video;
use DateTime;
use PHPUnit\Framework\TestCase;

class TrickTest extends TestCase
{
        public function testTrickGetCreatedAt()
    {
        $trick = new Trick();
        $date = new DateTime();
        $trick->setCreatedAt($date);

        $test = $trick->getCreatedAt();

        $this->assertInstanceOf(DateTime::class, $test);
    }

    public function testTrickSetCreatedAt()
    {
        $trick = new Trick();
        $date = new DateTime();
        $test = $trick->setCreatedAt($date);

        $this->assertInstanceOf(Trick::class, $test);
    }

    public function testTrickGetGroupName()
    {
        $trick = new Trick();
        $group = $this->createMock(Group::class);
        $trick->setGroupName($group);

        $test = $trick->getGroupName();

        $this->assertInstanceOf(Group::class, $test);
        $this->assertSame($group, $test);
    }

    public function testTrickSetGroupName()
    {
        $trick = new Trick();
        $group = $this->createMock(Group::class);
        $test = $trick->setGroupName($group);

        $this->assertInstanceOf(Trick::class, $test);
    }

    public function testTrickGetVideos()
    {
        $trick = new Trick();
        $video1 = $this->createMock(Video::class);
        $video2 = $this->createMock(Video::class);

        $trick->addVideo($video1);
        $trick->addVideo($video2);

        $test = $trick->getVideos();

        $this->assertContainsOnlyInstancesOf(Video::class, $test);

    }
    public function testTrickGetImages()
    {
        $trick = new Trick();
        $image1 = $this->createMock(Image::class);
        $image2 = $this->createMock(Image::class);

        $trick->addImage($image1);
        $trick->addImage($image2);

        $test = $trick->getImages();

        $this->assertContainsOnlyInstancesOf(Image::class, $test);

    }

    public function testTrickGCommentsetUser()
    {
        $trick = new Trick();
        $user = $this->createMock(User::class);

        $trick->setUser($user);

        $test = $trick->getUser();

        $this->assertInstanceOf(User::class, $test);
        $this->assertSame($user , $test);
    }
    public function testTrickSetUser()
    {
        $trick = new Trick();
        $user = $this->createMock(User::class);

        $test = $trick->setUser($user);

        $this->assertInstanceOf(Trick::class, $test);
    }
    public function testTrickGetComments()
    {
        $trick = new Trick();
        $comment1 = $this->createMock(Comment::class);
        $comment2 = $this->createMock(Comment::class);

        $trick->addComment($comment1);
        $trick->addComment($comment2);

        $test = $trick->getComments();

        $this->assertContainsOnlyInstancesOf(Comment::class, $test);

    }
}