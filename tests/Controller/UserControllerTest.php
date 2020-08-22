<?php


namespace App\Tests\Controller;


use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserControllerTest extends ConfigNewVarForTest
{

    public function testUserRegistration()
    {
        //User Creation
        $client = static::createClient();

        $crawler = $client->request('GET', '/inscription');

        static::assertSame(1, $crawler->filter('h1.registration')->count());

        $form = $crawler->selectButton('S\'inscrire')->form();
        $form['register_user[username]'] = $this->userName;
        $form['register_user[email]'] = $this->email;
        $form['register_user[password][first]'] = $this->password;
        $form['register_user[password][second]'] = $this->password;
        $client->submit($form);

        $userRepository = static::$container->get(UserRepository::class);
        $testUser = $userRepository->findOneBy(['username' => $this->userName]);
        $testUserName = $testUser->getUsername();

        static::assertInstanceOf(User::class,$testUser);
        static::assertSame($this->userName,$testUserName);

    }

    public function testShowUser()
    {
        $client = static::createClient();

        $userRepository = static::$container->get(UserRepository::class);

        $testUser = $userRepository->findOneBy(['username'=>$this->userName]);
        $client->loginUser($testUser);

        $crawler = $client->request('GET', '/user/'.$testUser->getId());

        static::assertSame(1,$crawler->filter('h1.user_show')->count());

    }


}