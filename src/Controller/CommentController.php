<?php

namespace App\Controller;

use App\Entity\Trick;
use App\Form\CommentType;
use App\Service\Comment\AddComment;
use App\Service\Trick\Trickshow;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CommentController extends AbstractController
{
    /**
     * @Route("/comment", name="comment")
     */
    public function index()
    {
        return $this->render('comment/index.html.twig', [
            'controller_name' => 'CommentController',
        ]);
    }

    /**
     * @Route("trick/{slug}/add_comment", name="add_comment")
     * @param Request $request
     * @param Trick $trick
     * @param AddComment $addComment
     * @param Trickshow $trickShow
     * @param string $slug
     */

    public function addComment(Request $request,Trick $trick, AddComment $addComment, Trickshow $trickShow, $slug)
    {
        $formComment = $this->createForm(CommentType::class);
        $formComment->handleRequest($request);

        if ($formComment->isSubmitted() && $formComment->isValid()){
            $user = $this->getUser();
            $trick = $trickShow->showTrick($slug);

            $addComment->addComment($formComment,$trick,$user);

            return $this->redirectToRoute('trick_show',[
                'group_slug' => $trick->getGroupName()->getSlug(),
                'id' => $trick->getId(),
                'trick_slug' => $trick->getSlug()
            ]);
        }
        return $this->render('comment/addComment.html.twig',[
            'formComment' => $formComment->createView()
        ]);
    }
}
