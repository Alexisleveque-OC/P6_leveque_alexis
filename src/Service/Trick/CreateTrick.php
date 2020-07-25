<?php

namespace App\Service\Trick;

use App\Repository\UserRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\String\Slugger\AsciiSlugger;
use Symfony\Component\String\Slugger\SluggerInterface;

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
    /**
     * @var AsciiSlugger
     */
    private $slugger;


    public function __construct(EntityManagerInterface $manager, UserRepository $userRepository,SluggerInterface $slugger)
    {
        $this->manager = $manager;
        $this->userRepository = $userRepository;
        $this->slugger = $slugger;
    }


    public function saveTrick($formTrick, $user)
    {
        $trick = $formTrick->getData();

        $slug = $this->slugger->slug($trick->getName());
        $trick->setSlug($slug);

        $trick->setUser($user);
        if ($trick->getCreatedAt()) {
            $trick->setUpdatedAt(new DateTime());
        } else {
            $trick->setCreatedAt(new DateTime());
        }
        $this->manager->persist($trick);
        $this->manager->flush();

        return $trick;
    }
}