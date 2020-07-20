<?php


namespace App\Service\Trick;


use App\Repository\TrickRepository;

class Trickshow
{
    /**
     * @var TrickRepository
     */
    private $trickRepository;

    public function __construct(TrickRepository $trickRepository)
    {
        $this->trickRepository = $trickRepository;
    }

    public function showTrick($id)
    {
        return $this->trickRepository->findOneBy(['id'=>$id]);
    }
}