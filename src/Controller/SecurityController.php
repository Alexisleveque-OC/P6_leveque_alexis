<?php

namespace App\Controller;

use App\Entity\Token;
use App\Entity\User;
use App\Form\UserLoginType;
use App\Form\RegisterUserType;
use App\Repository\TokenRepository;
use App\Repository\UserRepository;
use App\Service\Mail\Mailer;
use App\Service\User\RegisterService;
use App\Service\User\ValidationService;
use Doctrine\ORM\EntityManagerInterface;
use phpDocumentor\Reflection\Types\Object_;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    /**
     * @Route("/inscription", name="registration")
     * @param Request $request
     * @param Mailer $mailer
     * @param RegisterService $registerService
     * @return RedirectResponse|Response
     */
    public function registration(Request $request, Mailer $mailer, RegisterService $registerService)
    {

        $form = $this->createForm(RegisterUserType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $token = $registerService->register($form);

            $mailer->sendUserTokenMail($token);

            $this->addFlash('success', 'Vous avez été enregistré, vérifiez vos email pour valideer votre compte !');
            return $this->redirectToRoute('home');
        }

        return $this->render('security/registration.html.twig', [
            'formUser' => $form->createView()
        ]);
    }

    /**
     * @Route("/validateUser/{token}", name="validation")
     * @param $token
     * @param ValidationService $validationService
     */
    public function validation($token, ValidationService $validationService)
    {
        $validationService->validateUser($token);

        $this->addFlash('success','Votre compte a été correctement validé !!!');

        return $this->render('security/accountValidated.html.twig');
    }


    /**
     * @Route("/login", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // if ($this->getUser()) {
        //     return $this->redirectToRoute('target_path');
        // }
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error,
        ]);
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout()
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }


}
