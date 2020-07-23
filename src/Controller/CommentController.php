<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Trick;
use App\Form\CommentType;
use App\Service\Comment\AddComment;
use App\Service\Comment\DeleteComment;
use App\Service\Trick\Trickshow;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
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
     * @return RedirectResponse|\Symfony\Component\HttpFoundation\Response
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

    /**
     * @Route("comment/delete/{id<\d+>}",name="delete_comment")
     * @param DeleteComment $deleteComment
     * @param Comment $comment
     * @param Trickshow $trickShow
     * @return RedirectResponse
     */
    public function deleteComment(DeleteComment $deleteComment,Comment $comment,TrickShow $trickShow)
    {
        $trick = $trickShow->showTrick($comment->getTrick()->getSlug());

        $deleteComment->delete($comment);

        return $this->redirectToRoute('trick_show',[
            'group_slug' => $trick->getGroupName()->getSlug(),
            'id' => $trick->getId(),
            'trick_slug' => $trick->getSlug()
        ]);
    }
}
