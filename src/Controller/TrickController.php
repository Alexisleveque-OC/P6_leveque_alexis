<?php

namespace App\Controller;

use App\Entity\Trick;
use App\Form\CommentType;
use App\Form\DeleteConfirmationType;
use App\Form\GroupType;
use App\Form\TrickCreateType;
use App\Service\Comment\ReadComments;
use App\Service\Trick\CreateGroup;
use App\Service\Trick\CreateTrick;
use App\Service\Trick\DeleteTrick;
use App\Service\Trick\Trickshow;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
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
     * @Route("/trick/{group_slug}/{id<\d+>}-{trick_slug}/edit", name="trick_edit")
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
                'group_slug'=> $trick->getGroupName()->getSlug(),
                'trick_slug' => $trick->getSlug()
                ]);
        }
        return $this->render('trick/createTrick.html.twig', [
            'formTrick' => $formTrick->createView(),
            'formGroup' => $formGroup->createView(),
            'editMode' => $trick->getId() !== null
        ]);
    }

    /**
     * @Route("/trick/{group_slug}/{id<\d+>}-{trick_slug}", name="trick_show")
     * @param String $trick_slug
     * @param Trickshow $trickShow
     * @param ReadComments $readComments
     * @param Request $request
     * @return Response
     */
    public function show($trick_slug, TrickShow $trickShow, ReadComments $readComments)
    {
        $form = $this->createForm(CommentType::class);

        $trick = $trickShow->showTrick($trick_slug);

        $comments = $readComments->readComments($trick);

        $question = false;

        return $this->render('trick/show.html.twig', [
            'trick' => $trick,
            'comments' => $comments,
            'question'=> $question,
            'formComment' => $form->createView()
        ]);
    }

    /**
     * @Route("/trick/delete_confirmation/{group_slug}/{id<\d+>}-{trick_slug}", name="deleteConf_trick")
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
