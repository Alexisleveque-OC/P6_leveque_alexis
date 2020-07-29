<?php

namespace App\Controller;

use App\Form\DeleteConfirmationType;
use App\Service\Trick\Tricks;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="home")
     * @Route("/page={line<\d+>}", name="more_tricks")
     * @param Tricks $readTricks
     * @param int $line
     * @return Response
     */
    public function home(Tricks $readTricks, $line = 1)
    {

        $tricks = $readTricks->readTricks($line);
        $formDeleteTrick = $this->createForm(DeleteConfirmationType::class);

        return $this->render('main/home.html.twig', [
            'tricks' => $tricks,
            'line' => $line,
            'formDeleteTrick' => $formDeleteTrick->createView()
        ]);
    }

}
