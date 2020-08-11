<?php


namespace App\Tests\Entity;

use App\Entity\Image;
use App\Entity\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function testUserGetUsername()
    {
        $user = new User();
        $user->setUsername('UserTest');

        $test = $user->getUsername();

        $this->assertSame('UserTest', $test);
    }

    public function testUserSetUsername()
    {
        $user = new User();
        $test = $user->setUsername('UserTest');

        $this->assertInstanceOf(User::class, $test);
    }

    public function testUserGetRoles()
    {
        $user = new User();
        $user->setRoles(['ROLE_USER']);

        $test = $user->getRoles();

        $this->assertEquals(['ROLE_USER'],$test);
    }

    public function testUserSetRoles()
    {
        $user = new User();
        $test = $user->setRoles(['ROLE_USER']);

        $this->assertInstanceOf(User::class, $test);
    }

    public function testUserGetPassword()
    {
        $user = new User();
        $user->setPassword('coucou');

        $test = $user->getPassword();

        $this->assertEquals('coucou',$test);
    }

    public function testUserSetPassword()
    {
        $user = new User();
        $test = $user->setPassword('coucou');

        $this->assertInstanceOf(User::class, $test);
    }

    public function testUserGetEMail()
    {
        $user = new User();
        $user->setEmail('userTest@test.com');

        $test = $user->getEmail();

        $this->assertEquals('userTest@test.com', $test);
    }

    public function testUserSetEMail()
    {
        $user = new User();
        $test = $user->setEMail('userTest@test.com');

        $this->assertInstanceOf(User::class, $test);
    }

    public function testUserGetValidation()
    {
        $user = new User();
        $user->setValidation(true);

        $test = $user->getValidation();

        $this->assertEquals(true, $test);
    }
    public function testUserSetValidation()
    {
        $user = new User();
        $test = $user->setValidation(true);

        $this->assertInstanceOf(User::class, $test);
    }

    public function testUserGetImage()
    {
        $user = new User();
        $image = $this->createMock(Image::class);
        $user->setImage($image);

        $test = $user->getImage();

        $this->assertInstanceOf(Image::class, $test);
    }
    public function testUserSetImage()
    {
        $user = new User();
        $image = $this->createMock(Image::class);

        $test = $user->setImage($image);

        $this->assertInstanceOf(User::class, $test);
    }
}