<?php

namespace App\Controller;

use App\Form\GroupType;
use App\Service\Trick\CreateGroup;
use phpDocumentor\Reflection\DocBlock\Tags\Return_;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class GroupController extends AbstractController
{
    /**
     * @Route("/group", name="group")
     */
    public function index()
    {
        return $this->render('group/index.html.twig', [
            'controller_name' => 'GroupController',
        ]);
    }

    /**
     * @Route("/group/create", name="group_create")
     * @param Request $request
     * @param CreateGroup $createGroup
     * @return \Symfony\Component\HttpFoundation\Response
     */

    public function create(Request $request,CreateGroup $createGroup)
    {
        $formGroup = $this->createForm(GroupType::class);
        $formGroup->handleRequest($request);

        if($formGroup->isSubmitted() && $formGroup->isValid())
        {
            $createGroup->saveGroup($formGroup);

            return $this->redirectToRoute('home');
        }
        return $this->render('group/create.html.twig',[
            'formGroup' => $formGroup->createView()
        ]);
    }
}
