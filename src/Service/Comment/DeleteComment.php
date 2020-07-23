<?php


namespace App\Service\Comment;


use Doctrine\ORM\EntityManagerInterface;

class DeleteComment
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function delete($comment)
    {
        $this->entityManager->remove($comment);
        $this->entityManager->flush();
    }
}