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

    public function showTrick($slug)
    {
        return $this->trickRepository->findOneBy(['slug'=>$slug]);
    }
}