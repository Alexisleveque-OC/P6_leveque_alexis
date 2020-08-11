<?php


namespace App\Tests\Controller;


use App\Controller\SecurityController;
use App\Entity\User;
use App\Repository\TokenRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SecurityTest extends ConfigNewEnvForTest

{
    public function setUp()
    {
        $manager = $this->createMock(EntityManagerInterface::class);
        $abstractController = $this->createMock(AbstractController::class);
    }

    public function testValidation()
    {
        $client = static::createClient();

        $userRepository = static::$container->get(UserRepository::class);
        $testUser = $userRepository->findOneBy(['username' => $this->userName]);

        $tokenRepository = static::$container->get(TokenRepository::class);
        $token = $tokenRepository->findOneBy(['id' => $testUser->getId()]);

        $test = $testUser->getValidation();

        static::assertSame(false, $test);

        $crawler = $client->request('GET', '/validateUser/' . $token->getToken());
        $test = $testUser->getValidation();

        static::assertSame(true, $test);

        static::assertSame(1, $crawler->filter('div.alert.alert-success')->count());

    }

    public function testLogin()
    {
        $client = static::createClient();
        $userConnected = $this->createMock(SecurityController::class);
        $userTest = $this->createMock(User::class);

        $crawler = $client->request('GET', '/login');
        static::assertSame(1, $crawler->filter('div.form_login')->count());

        $user = new User();
        $user->setUsername($this->userName);
        $user->setEmail($this->email);
        $user->setPassword($this->password);
        $user->setValidation(true);

        $form = $crawler->selectButton('Connexion')->form();
        $form['email'] = $this->userName;
        $form['password'] = $this->password;
        $client->submit($form);

        $client->loginUser($user);

        $crawler = $client->followRedirect();

        $userConnected
            ->method('getUser')
        ->willReturn($userTest);

        static::assertSame(1, $crawler->filter('h1#homeSentence')->count());
        static::assertSame($user, $userConnected);

    }

    public function testForgotPassword()
    {
        $client = static::createClient();

        $userRepository = static::$container->get(UserRepository::class);
        $testUser = $userRepository->findOneBy(['email' => $this->email]);

        $tokenRepository = static::$container->get(TokenRepository::class);
        $tokenBefore = $tokenRepository->findOneBy(['id' => $testUser->getId()]);

        $crawler = $client->request('GET', '/login/forgotPass');
        static::assertSame(1, $crawler->filter('div.form_forgotPass')->count());

        $form = $crawler->selectButton('Renvoyer moi un mail pour changer de mot de passe')->form();
        $form['forgot_pass[email]'] = $this->email;
        $client->submit($form);

        $tokenAfter = $tokenRepository->findOneBy(['id' => $testUser->getId()]);

        static::assertNotEquals($tokenAfter->getToken(),$tokenBefore->getToken());

    }

    public function testResetPass()
    {
        $client = static::createClient();

        $userRepository = static::$container->get(UserRepository::class);
        $testUser = $userRepository->findOneBy(['email' => $this->email]);

        $tokenRepository = static::$container->get(TokenRepository::class);
        $token = $tokenRepository->findOneBy(['id' => $testUser->getId()]);

        $crawler = $client->request('GET', '/login/resetPass/'.$token->getToken());

        static::assertSame(1, $crawler->filter('div.form_resetPass')->count());

        $form = $crawler->selectButton('Enregistrer mon nouveau mot de passe')->form();
        $form['new_password[password][first]'] = $this->password;
        $form['new_password[password][second]'] = $this->password;
        $client->submit($form);

        $userRepository = static::$container->get(UserRepository::class);
        $testUserafter = $userRepository->findOneBy(['email' => $this->email]);

        static::assertNotEquals($testUserafter->getPassword(),$testUser->getPassword());

        $crawler = $client->followRedirect();

        static::assertSame(1,$crawler->filter('div.form_login')->count());

    }
}