<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\ImageType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    /**
     * @Route("/user/{id<\d+>}", name="user_show")
     * @param User $user
     * @return Response
     */
    public function show(User $user)
    {
        $form = $this->createForm(ImageType::class);

        return $this->render('user/show.html.twig',[
            'formImage' => $form->createView(),
            'user'=>$user
        ]);
    }
}
