<?php


namespace App\Service\User;


use App\Entity\User;
use App\Repository\TokenRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;

class ResetUser
{
    /**
     * @var EntityManagerInterface
     */
    private $manager;
    /**
     * @var UserRepository
     */
    private $userRepository;
    /**
     * @var TokenRepository
     */
    private $tokenRepository;

    public function __construct(EntityManagerInterface $manager,UserRepository $userRepository, TokenRepository $tokenRepository)
    {
        $this->manager = $manager;
        $this->userRepository = $userRepository;
        $this->tokenRepository = $tokenRepository;
    }

    public function resetUser($form)
    {
        $user = new User();
        $form = $form->getData();
        $email = $form['email'];

        $user = $this->userRepository->findOneBy(["email" => $email]);
        $token = $this->tokenRepository->findOneBy(["user" => $user]);

        $user->setValidation(false);
        $this->manager->persist($user);
        $this->manager->flush();

        $newToken = $token->generateToken();
        $token->setToken($newToken);

        $this->manager->persist($token);
        $this->manager->flush();

        return $token;
    }
}