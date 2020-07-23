<?php


namespace App\Service\Comment;


use App\Repository\CommentRepository;

class ReadComments
{
    /**
     * @var CommentRepository
     */
    private $commentRepository;

    public function __construct(CommentRepository $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    public function readComments($trick)
    {
        return $this->commentRepository->findBy(['trick'=>$trick],['id' => 'DESC']);
    }
}