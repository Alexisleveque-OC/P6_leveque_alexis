<?php


namespace App\Service\Trick;


use Doctrine\ORM\EntityManagerInterface;

class CreateTrick
{
    /**
     * @var EntityManagerInterface
     */
    private $manager;

    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    public function save($formTrick)
    {
        $trick = $formTrick->getData();
        $trick->setCreatedAt(new \DateTime());
        $this->manager->persist($trick);
        $this->manager->flush();
    }
}