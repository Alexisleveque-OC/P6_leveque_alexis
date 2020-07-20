<?php

namespace App\Controller;

use App\Entity\Trick;
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
     * @Route("/trick/{id}/edit", name="trick_edit")
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
            return $this->redirectToRoute('trick_show', ['id' => $trick->getId()]);
        }
        return $this->render('trick/createTrick.html.twig', [
            'formTrick' => $formTrick->createView(),
            'formGroup'=> $formGroup->createView(),
            'editMode' => $trick->getId() !== null
        ]);
    }

    /**
     * @Route("/trick/{id}", name="trick_show")
     * @param Trickshow $trickShow
     * @param $id int
     * @return Response
     */
    public function show(TrickShow $trickShow, $id)
    {
        $trick = $trickShow->showTrick($id);

        return $this->render('trick/show.html.twig', [
            'trick' => $trick
        ]);
    }

    /**
     * @Route("/trick/delete/{id}", name="deleteConf_trick")
     * @Route("/trick/delete/{id}/{answer}", name="delete_trick")
     * @param DeleteTrick $deleteTrick
     * @param Trick $trick
     * @param null $answer
     * @return Response
     */
    public function delete(DeleteTrick $deleteTrick, Trick $trick, $answer = null)
    {

        if ($answer == true) {
            $deleteTrick->delete($trick);
            return $this->redirectToRoute('home');
        }

        $question = true;
        return $this->render('trick/show.html.twig', [
            'question' => $question,
            'trick' => $trick
        ]);
    }
}
