<?php


namespace App\Tests\Entity;


use App\Entity\Comment;
use App\Entity\Trick;
use App\Entity\User;
use PHPUnit\Framework\TestCase;

class CommentTest extends TestCase
{
    public function testCommentGetContent()
    {
        $comment = new Comment();
        $comment->setContent('coucou');

        $test = $comment->getContent();

        $this->assertSame('coucou',$test);
    }

    public function testCommentSetContent()
    {
        $comment = new Comment();
        $test = $comment->setContent('coucou');

        $this->assertInstanceOf(Comment::class,$test);
    }

    public function testCommentGetCreatedAt()
    {
        $comment = new Comment();
        $createdAt = new \DateTime();
        $comment->setCreatedAt($createdAt);

        $test = $comment->getCreatedAt();

        $this->assertSame($createdAt,$test);
    }

    public function testCommentSetCreatedAt()
    {
        $comment = new Comment();
        $test = $comment->setCreatedAt(new \DateTime());

        $this->assertInstanceOf(Comment::class,$test);
    }

    public function testCommentGetUser()
    {
        $comment = new Comment();
        $comment->setUser(new User());

        $test = $comment->getUser();

        $this->assertInstanceOf(User::class,$test);
    }

    public function testCommentSetUser()
    {
        $comment = new Comment();
        $test = $comment->setUser(new User());

        $this->assertInstanceOf(Comment::class,$test);
    }
    public function testCommentGetTrick()
    {
        $comment = new Comment();
        $comment->setTrick(new Trick());

        $test = $comment->getTrick();

        $this->assertInstanceOf(Trick::class,$test);
    }

    public function testCommentSetTrick()
    {
        $comment = new Comment();
        $test = $comment->setTrick(new Trick());

        $this->assertInstanceOf(Comment::class,$test);
    }
}