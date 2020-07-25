<?php


namespace App\Service\User;


use App\Entity\Token;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegisterService
{
    /**
     * @var UserPasswordEncoderInterface
     */
    private $encoder;
    /**
     * @var EntityManagerInterface
     */
    private $manager;

    public function __construct(EntityManagerInterface $manager , UserPasswordEncoderInterface $encoder)
    {
        $this->manager = $manager;
        $this->encoder = $encoder;
    }
    public function register($form)
    {
        $user = $form->getData();
        $hash = $this->encoder->encodePassword($user, $user->getPassword());
        $user->setPassword($hash);
        $this->manager->persist($user);
        $token = new Token();
        $token->setUser($user);
        $this->manager->persist($token);
        $this->manager->flush();

        return $token;
    }
}