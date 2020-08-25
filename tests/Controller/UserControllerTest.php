<?php


namespace App\Tests\Controller;


use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserControllerTest extends WebTestCase
{

    public function testUserRegistration()
    {
        //User Creation
        $client = static::createClient();

        $crawler = $client->request('GET', '/inscription');

        static::assertSame(1, $crawler->filter('h1.registration')->count());

        $form = $crawler->selectButton('S\'inscrire')->form();
        $form['register_user[username]'] = 'UserTest';
        $form['register_user[email]'] = 'UserTest@test.com';
        $form['register_user[password][first]'] = 'passTest';
        $form['register_user[password][second]'] = 'passTest';
        $client->submit($form);

        $userRepository = static::$container->get(UserRepository::class);
        $testUser = $userRepository->findOneBy(['username' => 'UserTest']);
        $testUserName = $testUser->getUsername();

        static::assertInstanceOf(User::class,$testUser);
        static::assertSame('UserTest',$testUserName);

    }

    public function testShowUser()
    {
        $client = static::createClient();

        $userRepository = static::$container->get(UserRepository::class);

        $testUser = $userRepository->findOneBy(['username'=>'UserTest']);
        $client->loginUser($testUser);

        $crawler = $client->request('GET', '/user/'.$testUser->getId());

        static::assertSame(1,$crawler->filter('h1.user_show')->count());

    }


}