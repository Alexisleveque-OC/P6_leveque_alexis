<?php

namespace App\Controller;

use App\Entity\Trick;
use App\Form\PictureType;
use App\Form\VideoType;
use App\Service\Upload\SaveImage;
use App\Service\Upload\SaveVideoTrick;
use App\Service\Upload\UploadImage;
use Exception;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
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
     */
    public function uploadImageUser(Request $request, UploadImage $uploadImage, SaveImage $saveImage )
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

        $form = $this->createForm(PictureType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $uploadedImage = $form->get("photo")->getData();

            if($uploadedImage) {
                $newFileName = $uploadImage->saveImage($uploadedImage);
                $user = $this->getUser();
                $saveImage->saveOnUser($newFileName, $user);

                $this->addFlash('success','Votre photo de profil à bien été modifié.');

                return $this->redirectToRoute('user_show',['id' => $user->getId()]);
            }
        }

        return $this->render('upload/image.html.twig',[
            'formImage' => $form->createView()
        ]);
    }

    /**
     * @Route("/upload/image_trick/{id}", name="upload_trick_image")
     * @IsGranted("ROLE_USER")
     * @param Request $request
     * @param UploadImage $uploadImage
     * @param SaveImage $saveImage
     * @param Trick $trick
     * @return RedirectResponse|Response
     * @throws Exception
     */
    public function uploadImageTrick(Request $request, UploadImage $uploadImage, SaveImage $saveImage,Trick $trick)
    {
        $form = $this->createForm(PictureType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $uploadedImage = $form->get("photo")->getData();

            if($uploadedImage) {
                $newFileName = $uploadImage->saveImage($uploadedImage);
                $saveImage->saveOnTrick($newFileName, $trick);

                $this->addFlash('success','Votre image à bien été enregistré.');

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

    /**
     * @Route("upload/video_trick/{id}", name="upload_trick_video")
     * @param Request $request
     * @param Trick $trick
     * @param SaveVideoTrick $saveVideoTrick
     * @return Response
     */
    public function uploadVideoTrick(Request $request, Trick $trick, SaveVideoTrick $saveVideoTrick)
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

        $form = $this->createForm(VideoType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $iFrame = $form->get('iFrame')->getData();
            $saveVideoTrick->saveOnTrick($iFrame,$trick);

            $this->addFlash('success','Votre vidéo à bien été enregistré.');


            return $this->redirectToRoute('trick_show',[
                'id' => $trick->getId(),
                'group_slug' =>$trick->getGroupName()->getSlug(),
                'trick_slug' => $trick->getSlug()
            ]);
        }

        return $this->render('upload/video.html.twig',[
            'formVideo'=> $form->createView()
        ]);
    }
}
