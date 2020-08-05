<?php

namespace App\Controller;

use App\Entity\Trick;
use App\Form\CommentType;
use App\Form\DeleteCommentType;
use App\Form\DeleteConfirmationType;
use App\Form\GroupType;
use App\Form\TrickCreateType;
use App\Service\Trick\CreateTrick;
use App\Service\Trick\DeleteTrick;
use App\Service\Trick\TrickShow;
use App\Service\Upload\SaveImage;
use App\Service\Upload\UploadImage;
use Doctrine\Common\Collections\ArrayCollection;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
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
     * @return Response
     * @IsGranted("ROLE_USER")
     */
    public function create(Trick $trick = null, Request $request, CreateTrick $createTrick, UploadImage $uploadImage, SaveImage $saveImage)
    {

        if (!$trick) {
            $trick = new Trick();
        }

        $originalImages = new ArrayCollection();
        $originalVideos = new ArrayCollection();

        foreach ($trick->getImages() as $image) {
            $originalImages->add($image);
        }

        foreach ($trick->getVideos() as $video){
            $originalVideos->add($video);
        }

        $formTrick = $this->createForm(TrickCreateType::class, $trick);
        $formTrick->handleRequest($request);

        $formGroup = $this->createForm(GroupType::class);

        if ($formTrick->isSubmitted() && $formTrick->isValid()) {
            $user = $this->getUser();
            foreach ($originalImages as $image) {
                if (false === $trick->getImages()->contains($image)) {
                    $trick->removeImage($image);
                }
            }
            foreach ($originalVideos as $video) {
                if (false === $trick->getVideos()->contains($video)) {
                    $trick->removeVideo($video);
                }
            }
            $trick = $createTrick->saveTrick($formTrick, $user);

            return $this->redirectToRoute('trick_show', [
                'id' => $trick->getId(),
                'group_slug' => $trick->getGroupName()->getSlug(),
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
     * @Route("/trick/{group_slug}/{id<\d+>}-{trick_slug}page={page}", name="trick_show")
     * @param String $trick_slug
     * @param TrickShow $TrickShow
     * @param int $page
     * @return Response
     */
    public function show($trick_slug, TrickShow $TrickShow, $page = 1)
    {
        $formComment = $this->createForm(CommentType::class);
        $formDeleteComment = $this->createForm(DeleteCommentType::class);
        $formDeleteTrick = $this->createForm(DeleteConfirmationType::class);

        $trick = $TrickShow->showTrick($trick_slug);

        return $this->render('trick/show.html.twig', [
            'trick' => $trick,
            'formComment' => $formComment->createView(),
            'formDeleteComment' => $formDeleteComment->createView(),
            'formDeleteTrick' => $formDeleteTrick->createView(),
            'page' => $page
        ]);
    }

    /**
     * @Route("/trick/delete/{id<\d+>}", name="delete_trick")
     * @param DeleteTrick $deleteTrick
     * @param Trick $trick
     * @param Request $request
     * @return Response
     * @IsGranted("ROLE_USER")
     */
    public function delete(DeleteTrick $deleteTrick, Trick $trick, Request $request)
    {
        $formDeleteTrick = $this->createForm(DeleteConfirmationType::class);
        $formDeleteTrick->handleRequest($request);

        if ($formDeleteTrick->isSubmitted() && $formDeleteTrick->isValid()) {

            $deleteTrick->delete($trick);
            $this->addFlash('warning', "Le trick à bien été supprimé.");
            return $this->redirectToRoute('home');
        }

        $this->addFlash('danger', "Il y à eu un problème lors de la suppression du trick");
        return $this->redirectToRoute('home');

    }
}
