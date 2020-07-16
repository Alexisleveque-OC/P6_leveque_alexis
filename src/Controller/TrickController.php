<?php

namespace App\Controller;

use App\Entity\Trick;
use App\Form\TrickCreateType;
use App\Service\Trick\CreateTrick;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class TrickController extends AbstractController
{
    /**
     * @Route("/trick", name="trick")
     */
    public function index()
    {
        return $this->render('trick/index.html.twig', [
            'controller_name' => 'TrickController',
        ]);
    }

    /**
     * @Route("/trick/creation", name="trick_create")
     * @Route("/trick/{id}/edit", name="trick_edit")
     * @param Request $request
     * @param CreateTrick $createTrick
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function create(Request $request,CreateTrick $createTrick)
    {
        $formTrick = $this->createForm(TrickCreateType::class);
        $formTrick->handleRequest($request);

        if($formTrick->isSubmitted() && $formTrick->isValid())
        {
            $createTrick->save($formTrick);
        }
        return $this->render('trick/createTrick.hmtl.twig',[
            'formTrick' => $formTrick->createView()
        ]);
    }
}
