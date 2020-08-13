<?php


namespace App\Tests\Entity;


use App\Entity\Group;
use App\Entity\Trick;
use Doctrine\Common\Collections\ArrayCollection;
use PHPUnit\Framework\TestCase;

class GroupTest extends TestCase
{

    public function testGroupGetTitle()
    {
        $group = new Group();
        $group->setTitle('coucou');

        $test = $group->getTitle();

        $this->assertSame('coucou', $test);
    }

    public function testGroupSetTitle()
    {
        $group = new Group();
        $test = $group->setTitle('coucou');

        $this->assertInstanceOf(Group::class, $test);
    }
    public function testGroupGetDescription()
    {
        $group = new Group();
        $group->setDescription('coucou');

        $test = $group->getDescription();

        $this->assertSame('coucou',$test);
    }

    public function testGroupSetDescription()
    {
        $group = new Group();
        $test = $group->setDescription('coucou');

        $this->assertInstanceOf(Group::class,$test);
    }
    public function testGroupGetSlug()
    {
        $group = new Group();
        $group->setSlug('coucou');

        $test = $group->getSlug();

        $this->assertSame('coucou',$test);
    }

    public function testGroupSetSlug()
    {
        $group = new Group();
        $test = $group->setSlug('coucou');

        $this->assertInstanceOf(Group::class,$test);
    }

    public function testGroupAddtrick()
    {
        $group = new Group();
        $group->addtrick(new Trick());
        $test = $group->gettrick();

        $this->assertInstanceOf(ArrayCollection::class, $test);
    }

    public function testGroupGettrick()
    {
        $group = new Group();
        $test = $group->gettrick();

        $this->assertInstanceOf(ArrayCollection::class, $test);
    }
}