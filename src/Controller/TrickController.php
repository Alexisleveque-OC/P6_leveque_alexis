<?php

namespace App\Controller;

use App\Form\GroupType;
use App\Form\TrickCreateType;
use App\Service\Trick\CreateGroup;
use App\Service\Trick\CreateTrick;
use App\Service\Trick\Trickshow;
use http\Client\Curl\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

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
     * @Route("/trick/{id}", name="trick_show")
     * @param Trickshow $trickShow
     * @param $id
     */
    public function show(TrickShow $trickShow, $id)
    {
        $trick = $trickShow->showTrick($id);

        return $this->render('trick/show.html.twig',[
            'trick' => $trick
            ]);
    }

    /**
     * @Route("/trick/creation", name="trick_create")
     * @Route("/trick/{id}/edit", name="trick_edit")
     * @param Request $request
     * @param CreateTrick $createTrick
     * @return Response
     */
    public function create(Request $request, CreateTrick $createTrick)
    {
        $formTrick = $this->createForm(TrickCreateType::class);
        $formTrick->handleRequest($request);

//        $formGroup = $this->createForm(GroupType::class);
//        $formGroup->handleRequest($request);
//
//        if($formGroup->isSubmitted() && $formGroup->isValid())
//        {
//            $createGroup->saveGroup($formGroup);
//        }
        if ($formTrick->isSubmitted() && $formTrick->isValid()) {

            $user = $this->getUser();

            $createTrick->saveTrick($formTrick, $user);
            return $this->redirectToRoute('home');
            // TODO : A modifier quand show sera créer
        }
        return $this->render('trick/createTrick.html.twig', [
            'formTrick' => $formTrick->createView()
        ]);
    }
}
