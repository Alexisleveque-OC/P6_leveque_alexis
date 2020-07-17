<?php


namespace App\Service\Trick;


use Doctrine\ORM\EntityManagerInterface;

class CreateGroup
{
    /**
     * @var EntityManagerInterface
     */
    private $manager;

    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    public function saveGroup($formGroup)
    {
        $group = $formGroup->getData();
        $this->manager->persist($group);
        $this->manager->flush();

    }
}