<?php

namespace App\Controller;

use App\Form\GroupType;
use App\Form\TrickCreateType;
use App\Service\Trick\CreateGroup;
use App\Service\Trick\CreateTrick;
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
     * @param CreateGroup $createGroup
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function create(Request $request,CreateTrick $createTrick,CreateGroup $createGroup)
    {
        $formTrick = $this->createForm(TrickCreateType::class);
        $formTrick->handleRequest($request);

        $formGroup = $this->createForm(GroupType::class);
        $formGroup->handleRequest($request);

        if($formGroup->isSubmitted() && $formGroup->isValid())
        {
            $createGroup->saveGroup($formGroup);
        }

        if($formTrick->isSubmitted() && $formTrick->isValid())
        {
            $createTrick->saveTrick($formTrick);
            return $this->redirectToRoute('home');
            // TODo : A modifier quand show sera créer
        }
        return $this->render('trick/createTrick.hmtl.twig',[
            'formTrick' => $formTrick->createView(),
            'formGroup' => $formGroup->createView()
        ]);
    }
}
