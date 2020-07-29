<?php


namespace App\Service\Trick;


use App\Repository\TrickRepository;

class Tricks
{
    /**
     * @var TrickRepository
     */
    private $trickRepository;

    public function __construct(TrickRepository $trickRepository)
    {
        $this->trickRepository = $trickRepository;
    }

    public function list()
    {
        return $this->trickRepository->findBy([], ['id' => 'DESC']);
    }
}