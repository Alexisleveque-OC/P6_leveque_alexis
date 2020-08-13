<?php

namespace App\Controller;

use App\Form\ImageType;
use App\Service\Upload\SaveImage;
use App\Service\Upload\UploadImage;
use Exception;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UploadController extends AbstractController
{

    /**
     * @Route("/upload/image_user/{id<\d+>}", name="upload_user_image")
     * @param Request $request
     * @param UploadImage $uploadImage
     * @param SaveImage $saveImage
     * @return Response
     * @throws Exception
     * @IsGranted("ROLE_USER")
     */
    public function uploadImageUser(Request $request, UploadImage $uploadImage, SaveImage $saveImage )
    {
        $form = $this->createForm(ImageType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $image = $form->getData();

            if($image->getFile()) {
                $uploadImage->saveImageInServer($image);
                $user = $this->getUser();
                $saveImage->saveOnUser($image, $user);

                $this->addFlash('success','Votre photo de profil à bien été modifié.');

                return $this->redirectToRoute('user_show',['id' => $user->getId()]);
            }
        }

        return $this->render('upload/image.html.twig',[
            'formImage' => $form->createView()
        ]);
    }
}
