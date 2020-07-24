<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\ImageType;
use App\Service\Upload\UploadImage;
use App\Service\User\SaveImage;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
     */
    public function uploadImage(Request $request, UploadImage $uploadImage, SaveImage $saveImage )
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
}
