<?php


namespace App\Service\Comment;


use DateTime;
use Doctrine\ORM\EntityManagerInterface;

class AddComment
{
    /**
     * @var EntityManagerInterface
     */
    private $manager;

    public function __construct(EntityManagerInterface $manager)
    {

        $this->manager = $manager;
    }

    public function addComment($form,$trick,$user)
    {
        $comment = $form->getData();

        $comment->setUser($user);
        $comment->setTrick($trick);
        $comment->setCreatedAt(new DateTime());

        $this->manager->persist($comment);
        $this->manager->flush();
    }
}