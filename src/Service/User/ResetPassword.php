<?php


namespace App\Service\User;


use App\Repository\TokenRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class ResetPassword
{
    /**
     * @var TokenRepository
     */
    private $tokenRepository;
    /**
     * @var EntityManagerInterface
     */
    private $manager;
    /**
     * @var UserPasswordEncoderInterface
     */
    private $encoder;

    public function __construct(EntityManagerInterface $manager, UserPasswordEncoderInterface $encoder, TokenRepository $tokenRepository)
    {
        $this->manager = $manager;
        $this->tokenRepository = $tokenRepository;
        $this->encoder = $encoder;
    }

    public function resetPassword($form, $token)
    {
        $form = $form->getData();
        $token = $this->tokenRepository->findOneBy(["token" => $token]);
        $user = $token->getUser();

        $hash = $this->encoder->encodePassword($user, $form['password']);
        $user->setPassword($hash);

        $this->manager->persist($user);
        $this->manager->flush();

    }

}