<?php


namespace App\Tests\Service;


use App\Entity\Token;
use App\Entity\User;
use App\Service\User\RegisterService;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\TestCase;
use Symfony\Component\DomCrawler\Form;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegisterServiceTest extends TestCase
{
    private $registerService;

    public function setUp()
    {
        $manager = $this->createMock(EntityManagerInterface::class);
        $encoder = $this->createMock(UserPasswordEncoderInterface::class);
        $encoder->method('encodePassword')
            ->willReturn('hash');
        $this->registerService = new RegisterService($manager, $encoder);

//        return $this->registerService;
    }

    public function userProvider()
    {
        $user = new User();
        $user->setUsername('toto')
            ->setEmail('UserTest@gmail.com')
            ->setPassword('PassTest');

        return [[$user]];
    }

    /**
     * @dataProvider userProvider
     * @param User $user
     */
    public function testRegister(User $user)
    {
        $test = $this->registerService->register($user);

        $this->assertInstanceOf(Token::class, $test);
        $this->assertEquals($test->getId(), $user->getId());
    }
}