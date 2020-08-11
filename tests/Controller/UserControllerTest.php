<?php


namespace App\Tests\Controller;


use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserControllerTest extends ConfigNewEnvForTest
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

        $crawler = $client->followRedirect();
        static::assertSame(1,$crawler->filter('h1#homeSentence')->count());

    }

    public function testShowUser()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/user/1');

        static::assertSame(1,$crawler->filter('h1.user_show')->count());

    }


}