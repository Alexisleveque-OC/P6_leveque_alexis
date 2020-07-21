<?php

namespace App\Controller;

use App\Entity\Trick;
use App\Form\DeleteConfirmationType;
use App\Form\GroupType;
use App\Form\TrickCreateType;
use App\Service\Trick\CreateGroup;
use App\Service\Trick\CreateTrick;
use App\Service\Trick\DeleteTrick;
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
     * @Route("/trick/creation", name="trick_create")
     * @Route("/trick/{groupSlug}/{id<\d+>}-{trickSlug}/edit", name="trick_edit")
     * @param Trick|null $trick
     * @param Request $request
     * @param CreateTrick $createTrick
     * @param CreateGroup $createGroup
     * @return Response
     */
    public function create(Trick $trick = null, Request $request, CreateTrick $createTrick, CreateGroup $createGroup)
    {
        if (!$trick) {
            $trick = new Trick();
        }
        $formTrick = $this->createForm(TrickCreateType::class, $trick);
        $formTrick->handleRequest($request);

        $formGroup = $this->createForm(GroupType::class);

        if ($formTrick->isSubmitted() && $formTrick->isValid()) {
            $user = $this->getUser();

            $trick = $createTrick->saveTrick($formTrick, $user);
            return $this->redirectToRoute('trick_show', [
                'id' => $trick->getId(),
                'groupSlug'=> $trick->getGroupName()->getSlug(),
                'trickSlug' => $trick->getSlug()
                ]);
        }
        return $this->render('trick/createTrick.html.twig', [
            'formTrick' => $formTrick->createView(),
            'formGroup' => $formGroup->createView(),
            'editMode' => $trick->getId() !== null
        ]);
    }

    /**
     * @Route("/trick/{groupSlug}/{id<\d+>}-{trickSlug}", name="trick_show")
     * @param Trickshow $trickShow
     * @param String $trickSlug
     * @return Response
     */
    public function show(TrickShow $trickShow, $trickSlug)
    {
        $trick = $trickShow->showTrick($trickSlug);

        $question = false;

        return $this->render('trick/show.html.twig', [
            'trick' => $trick,
            'question'=> $question
        ]);
    }

    /**
     * @Route("/trick/delete_confirmation/{groupSlug}/{id<\d+>}-{trickSlug}", name="deleteConf_trick")
     * @param Trick $trick
     * @param Request $request
     * @return Response
     */
    public function confirmDelete(Trick $trick, Request $request)
    {
        $formDeleteConf = $this->createForm(DeleteConfirmationType::class);
        $formDeleteConf->handleRequest($request);

        $question = true;

        return $this->render('trick/show.html.twig', [
            'trick' => $trick,
            'formDeleteConf' => $formDeleteConf,
            'question' => $question
        ]);

    }

    /**
     * @Route("/trick/delete/{id<\d+>}", name="delete_trick")
     * @param DeleteTrick $deleteTrick
     * @param Trick $trick
     * @return Response
     */
    public function delete(DeleteTrick $deleteTrick, Trick $trick)
    {
        $deleteTrick->delete($trick);
        return $this->redirectToRoute('home');
    }
}
