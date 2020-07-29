<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\ImageType;
use App\Form\RegisterUserType;
use App\Service\Mail\Mailer;
use App\Service\User\RegisterService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    /**
     * @Route("/inscription", name="registration")
     * @param Request $request
     * @param Mailer $mailer
     * @param RegisterService $registerService
     * @return RedirectResponse|Response
     * @throws TransportExceptionInterface
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function registration(Request $request, Mailer $mailer, RegisterService $registerService)
    {

        $form = $this->createForm(RegisterUserType::class);
        $form->handleRequest($request);

        $formImage = $this->createForm(ImageType::class);

        if ($form->isSubmitted() && $form->isValid()) {

            $token = $registerService->register($form);

            $mailer->sendUserTokenMail($token);

            $this->addFlash('success', 'Vous avez été enregistré, vérifiez vos email pour valider votre compte !');
            return $this->redirectToRoute('home');
        }

        return $this->render('security/registration.html.twig', [
            'formUser' => $form->createView(),
            'formImage' => $formImage->createView()
        ]);
    }
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
