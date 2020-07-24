<?php


namespace App\Service\User;


use App\Repository\UserRepository;

class showUser
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function showUser($id)
    {
        $user = $this->userRepository->findOneBy(['id'=>$id]);

        return $user;
    }
}