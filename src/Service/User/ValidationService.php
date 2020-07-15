<?php


namespace App\Service\User;

use App\Repository\TokenRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;

class ValidationService
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
     * @var UserRepository
     */
    private $userRepository;

    public function __construct(EntityManagerInterface $manager, TokenRepository $tokenRepository,UserRepository $userRepository)
    {
        $this->manager = $manager;
        $this->tokenRepository = $tokenRepository;
        $this->userRepository = $userRepository;
    }

    public function validateUser($token)
    {
        $tokenTemp = $this->tokenRepository->findOneBy(['token'=>$token]);
        $user = $this->userRepository->findOneby(['id'=>$tokenTemp->getUser()->getId()]);

        $user->setValidation(true);

        $this->manager->persist($user);
        $this->manager->flush();
    }
}