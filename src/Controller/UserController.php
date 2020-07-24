<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\ImageType;
use App\Service\User\showUser;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    /**
     * @Route("/user", name="user")
     */
    public function index()
    {
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }

    /**
     * @Route("/user/{id<\d+>}", name="user_show")
     * @param showUser $showUser
     * @param User $user
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function show(showUser $showUser, User $user)
    {
        $form = $this->createForm(ImageType::class);

        return $this->render('user/show.html.twig',[
            'formImage' => $form->createView(),
            'user'=>$user
        ]);
    }
}
