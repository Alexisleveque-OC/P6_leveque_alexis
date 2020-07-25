<?php

namespace App\Controller;

use App\Entity\Trick;
use App\Form\CommentType;
use App\Form\DeleteCommentType;
use App\Form\DeleteConfirmationType;
use App\Form\GroupType;
use App\Form\ImageType;
use App\Form\TrickCreateType;
use App\Form\VideoType;
use App\Service\Comment\ReadComments;
use App\Service\Trick\CreateGroup;
use App\Service\Trick\CreateTrick;
use App\Service\Trick\DeleteTrick;
use App\Service\Trick\TrickShow;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TrickController extends AbstractController
{
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
        $this->denyAccessUnlessGranted('ROLE_USER');

        if (!$trick) {
            $trick = new Trick();
        }
        $formTrick = $this->createForm(TrickCreateType::class, $trick);
        $formTrick->handleRequest($request);

        $formGroup = $this->createForm(GroupType::class);

        if ($formTrick->isSubmitted() && $formTrick->isValid()) {
            $user = $this->getUser();

            $trick = $createTrick->saveTrick($formTrick, $user);

            $this->addFlash('success','Votre trick à bien été crée, ajoutez vos images et/ou vidéos.');

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
     * @param TrickShow $TrickShow
     * @param ReadComments $readComments
     * @return Response
     */
    public function show($trick_slug, TrickShow $TrickShow, ReadComments $readComments)
    {
        $formComment = $this->createForm(CommentType::class);
        $formDeleteComment = $this->createForm(DeleteCommentType::class);
        $formUploadImage = $this->createForm(ImageType::class);
        $formUploadVideo = $this->createForm(VideoType::class);

        $trick = $TrickShow->showTrick($trick_slug);

        $question = false;
        return $this->render('trick/show.html.twig', [
            'trick' => $trick,
            'question'=> $question,
            'formComment' => $formComment->createView(),
            'formDeleteComment' => $formDeleteComment->createView(),
            'formImage' => $formUploadImage->createView(),
            'formVideo' => $formUploadVideo->createView()
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
        $this->denyAccessUnlessGranted('ROLE_USER');

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
        $this->denyAccessUnlessGranted('ROLE_USER');

        $this->addFlash('danger', "Le trick à bien été supprimé.");
        $deleteTrick->delete($trick);
        return $this->redirectToRoute('home');
    }
}
