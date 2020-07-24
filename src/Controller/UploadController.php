<?php

namespace App\Controller;

use App\Entity\Trick;
use App\Entity\User;
use App\Form\ImageType;
use App\Service\Upload\UploadImage;
use App\Service\User\SaveImage;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UploadController extends AbstractController
{
    /**
     * @Route("/upload", name="upload")
     */
    public function index()
    {
        return $this->render('upload/index.html.twig', [
            'controller_name' => 'UploadController',
        ]);
    }

    /**
     * @Route("/upload/image_user/{id<\d+>}", name="upload_user_image")
     * @param Request $request
     * @param UploadImage $uploadImage
     * @param SaveImage $saveImage
     * @return Response
     * @throws Exception
     */
    public function uploadImageUser(Request $request, UploadImage $uploadImage, SaveImage $saveImage )
    {
        $form = $this->createForm(ImageType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $backupDirectory = $this->getParameter('images_directory');
            $uploadedImage = $form->get("photo")->getData();

            if($uploadedImage) {
                $newFileName = $uploadImage->saveImage($uploadedImage, $backupDirectory);
                $user = $this->getUser();
                $saveImage->saveOnUser($newFileName, $user);

                return $this->redirectToRoute('user_show',['id' => $user->getId()]);
            }
        }

        return $this->render('upload/image.html.twig',[
            'formImage' => $form->createView()
        ]);
    }

    /**
     * @Route("/upload/image_trick/{id}", name="upload_trick_image")
     * @param Request $request
     * @param UploadImage $uploadImage
     * @param SaveImage $saveImage
     * @param Trick $trick
     * @return RedirectResponse|Response
     * @throws Exception
     */
    public function uploadImageTrick(Request $request, UploadImage $uploadImage, SaveImage $saveImage,Trick $trick)
    {
        $form = $this->createForm(ImageType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $backupDirectory = $this->getParameter('images_directory');
            $uploadedImage = $form->get("photo")->getData();

            if($uploadedImage) {
                $newFileName = $uploadImage->saveImage($uploadedImage, $backupDirectory);
                $saveImage->saveOnTrick($newFileName, $trick);

                return $this->redirectToRoute('trick_show',[
                    'id' => $trick->getId(),
                    'group_slug' =>$trick->getGroupName()->getSlug(),
                    'trick_slug' => $trick->getSlug()
                    ]);
            }
        }

        return $this->render('upload/image.html.twig',[
            'formImage' => $form->createView()
        ]);
    }
}
