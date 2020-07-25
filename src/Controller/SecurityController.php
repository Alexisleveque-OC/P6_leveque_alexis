<?php

namespace App\Controller;

use App\Form\ForgotPassType;
use App\Form\ImageType;
use App\Form\NewPasswordType;
use App\Form\RegisterUserType;
use App\Service\Mail\Mailer;
use App\Service\User\RegisterService;
use App\Service\User\ResetPassword;
use App\Service\User\ResetUser;
use App\Service\User\ValidationService;
use LogicException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
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
     * @Route("/validateUser/{token}", name="validation")
     * @param $token
     * @param ValidationService $validationService
     * @return Response
     */
    public function validation($token, ValidationService $validationService)
    {
        $validationService->validateUser($token);

        $this->addFlash('success', 'Votre compte a été correctement validé !!!');

        return $this->render('security/accountValidated.html.twig');
    }


    /**
     * @Route("/login", name="app_login")
     * @param AuthenticationUtils $authenticationUtils
     * @return Response
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error,
        ]);
    }

    /**
     * @Route("login/forgotPass",name="forgot_pass")
     * @param Request $request
     * @param ResetUser $resetUser
     * @param Mailer $mailer
     * @return RedirectResponse|Response
     */
    public function forgotPassword(Request $request, ResetUser $resetUser, Mailer $mailer)
    {
        $form = $this->createForm(ForgotPassType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $token = $resetUser->resetUser($form);

            $mailer->sendResetPassword($token);
            $this->addFlash('success', 'Vous avez reçu un mail, validez votre email avant de continuer!');

            return $this->redirectToRoute('home');

        }

        return $this->render('security/forgotPass.html.twig', [
            'formForgot' => $form->createView()
        ]);
    }

    /**
     * @Route("login/resetPass/{token}",name="reset_pass")
     * @param Request $request
     * @param $token
     * @param ValidationService $validationService
     * @param ResetPassword $resetPassword
     * @return Response
     */
    public function resetPass(Request $request, $token, ValidationService $validationService, ResetPassword $resetPassword)
    {
        $form = $this->createForm(NewPasswordType::class);
        $form->handleRequest($request);

        $validationService->validateUser($token);

        if ($form->isSubmitted() && $form->isValid()) {
            $resetPassword->resetPassword($form, $token);

            $this->addFlash('success', 'Votre mot de passe a bien été modifié.');

            return $this->redirectToRoute('app_login');
        }

        return $this->render('security/resetPass.html.twig', [
            'formReset' => $form->createView()
        ]);
    }


    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout()
    {
        throw new LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }


}
