<?php

namespace App\Controller;

use App\Repository\TrickRepository;
use App\Service\Trick\ReadTricks;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/main", name="main")
     */
    public function index()
    {
        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }

    /**
     * @Route("/", name="home")
     * @Route("/{line}", name="more_tricks")
     * @param ReadTricks $readTricks
     * @param int $line
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function home(ReadTricks $readTricks, $line = 1)
    {
        $tricks = $readTricks->readTricks($line);

        $line++;

//        foreach ($tricks as $trick) {
//            $trick->setDescription(substr($trick->getDescription(), 0, 30) . ' ...');
//        }
        return $this->render('main/home.html.twig', [
            'tricks' => $tricks,
            'line' => $line
        ]);
    }

}
