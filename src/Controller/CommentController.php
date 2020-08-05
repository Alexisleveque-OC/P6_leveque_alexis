<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Trick;
use App\Form\CommentType;
use App\Service\Comment\AddComment;
use App\Service\Comment\DeleteComment;
use App\Service\Trick\TrickShow;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CommentController extends AbstractController
{
    /**
     * @Route("trick/{slug}/add_comment", name="add_comment")
     * @param Request $request
     * @param AddComment $addComment
     * @param TrickShow $TrickShow
     * @param string $slug
     * @return RedirectResponse|Response
     * @IsGranted("ROLE_USER")
     */

    public function addComment(Request $request, AddComment $addComment, TrickShow $TrickShow, $slug)
    {
        $formComment = $this->createForm(CommentType::class);
        $formComment->handleRequest($request);

        if ($formComment->isSubmitted() && $formComment->isValid()) {
            $user = $this->getUser();
            $trick = $TrickShow->showTrick($slug);

            $addComment->addComment($formComment, $trick, $user);

            $this->addFlash('success',"Votre commentaire à bien été enregistré.");

            return $this->redirectToRoute('trick_show', [
                'group_slug' => $trick->getGroupName()->getSlug(),
                'id' => $trick->getId(),
                'trick_slug' => $trick->getSlug()
            ]);
        }
        return $this->render('comment/addComment.html.twig', [
            'formComment' => $formComment->createView()
        ]);
    }

    /**
     * @Route("comment/delete/{id<\d+>}",name="delete_comment")
     * @param DeleteComment $deleteComment
     * @param Comment $comment
     * @param TrickShow $TrickShow
     * @return RedirectResponse
     * @IsGranted("ROLE_USER")
     */
    public function deleteComment(DeleteComment $deleteComment, Comment $comment, TrickShow $TrickShow)
    {

        $trick = $TrickShow->showTrick($comment->getTrick()->getSlug());

        $deleteComment->delete($comment);

        $this->addFlash('warning','Votre commentaire à été supprimé.');

        return $this->redirectToRoute('trick_show', [
            'group_slug' => $trick->getGroupName()->getSlug(),
            'id' => $trick->getId(),
            'trick_slug' => $trick->getSlug()
        ]);
    }
}
