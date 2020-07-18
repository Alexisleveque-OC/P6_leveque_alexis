<?php


namespace App\Service\Trick;


use App\Repository\TrickRepository;

class ReadTricks
{
    /**
     * @var TrickRepository
     */
    private $trickRepository;

    public function __construct(TrickRepository $trickRepository)
    {

        $this->trickRepository = $trickRepository;
    }

    public function readTricks($line)
    {
        $limit = $line * 4;

        $tricks = $this->trickRepository->findBy([], ['id' => 'DESC'], $limit, 0);

        foreach ($tricks as $trick) {
            $trick->setDescription(substr($trick->getDescription(), 0, 30) . ' ...');
        }
        return ($tricks);

    }

}