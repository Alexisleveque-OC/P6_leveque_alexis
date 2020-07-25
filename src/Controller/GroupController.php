<?php

namespace App\Controller;

use App\Form\GroupType;
use App\Service\Trick\CreateGroup;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GroupController extends AbstractController
{
    /**
     * @Route("/group/create", name="group_create")
     * @param Request $request
     * @param CreateGroup $createGroup
     * @return Response
     */

    public function create(Request $request, CreateGroup $createGroup)
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

        $formGroup = $this->createForm(GroupType::class);
        $formGroup->handleRequest($request);

        if ($formGroup->isSubmitted() && $formGroup->isValid()) {
            $createGroup->saveGroup($formGroup);

            $this->addFlash('success','Le groupe à bien été crée.');

            return $this->redirectToRoute('trick_create');
        }
        return $this->render('group/create.html.twig', [
            'formGroup' => $formGroup->createView()
        ]);
    }
}
