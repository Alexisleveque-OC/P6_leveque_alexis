<?php

namespace App\Service\Trick;

use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;

class CreateTrick
{
    /**
     * @var EntityManagerInterface
     */
    private $manager;
    /**
     * @var UserRepository
     */
    private $userRepository;


    public function __construct(EntityManagerInterface $manager, UserRepository $userRepository)
    {
        $this->manager = $manager;
        $this->userRepository = $userRepository;
    }


    public function saveTrick($formTrick, $user)
    {
        $trick = $formTrick->getData();

        $trick->setUser($user);
        if ($trick->getCreatedAt()) {
            $trick->setUpdatedAt(new \DateTime());
        } else {
            $trick->setCreatedAt(new \DateTime());
        }
        $this->manager->persist($trick);
        $this->manager->flush();

        return $trick;
    }
}