<?php


namespace App\Service\Trick;


use Doctrine\ORM\EntityManagerInterface;

class DeleteTrick
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function delete($trick)
    {
        $this->entityManager->remove($trick);
        $this->entityManager->flush();
    }
}