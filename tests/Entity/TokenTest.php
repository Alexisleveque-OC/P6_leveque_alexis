<?php


namespace App\Tests\Entity;


use App\Entity\Token;
use App\Entity\User;
use PHPUnit\Framework\TestCase;

class TokenTest extends TestCase
{
    public function testTokenConstructor()
    {
        $token = new Token();
        $test = $token->getToken();

        $this->assertNotEmpty($test);
}

    public function testTokenGetToken()
    {
        $token = new Token();
        $tokenGenerate = $token->generateToken();
        $token->setToken($tokenGenerate);

        $test = $token->getToken();

        $this->assertSame($tokenGenerate, $test);
    }

    public function testTokenSetToken()
    {
        $token = new Token();
        $test = $token->setToken('TokenTest');

        $this->assertInstanceOf(Token::class, $test);
    }
    public function testTokenGetUser()
    {
        $token = new Token();
        $user = $this->createMock(User::class);

        $token->setUser($user);

        $test = $token->getUser();

        $this->assertInstanceOf(User::class, $test);
    }

    public function testTokenSetUser()
    {
        $token = new Token();
        $user = $this->createMock(User::class);
        $test = $token->setUser($user);

        $this->assertInstanceOf(Token::class, $test);
    }
}