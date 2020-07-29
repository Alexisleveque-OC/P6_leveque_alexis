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
     * @Route("/page={page<\d+>}", name="more_tricks")
     * @param Tricks $readTricks
     * @param int $page
     * @return Response
     */
    public function home(Tricks $readTricks, $page = 0)
    {
        $tricks = $readTricks->list();
        $formDeleteTrick = $this->createForm(DeleteConfirmationType::class);

        return $this->render('main/home.html.twig', [
            'tricks' => $tricks,
            'page' => $page,
            'formDeleteTrick' => $formDeleteTrick->createView()
        ]);
    }

}
