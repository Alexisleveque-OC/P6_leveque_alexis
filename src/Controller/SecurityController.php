<?php

namespace App\Controller;

use App\Entity\Token;
use App\Entity\User;
use App\Form\UserLoginType;
use App\Form\UserType;
use App\Service\Mail\SendTokenByMail;
use Doctrine\ORM\EntityManagerInterface;
use phpDocumentor\Reflection\Types\Object_;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    /**
     * @Route("/inscription", name="registration")
     */
    public function registration(User $user = null, Token $token = null, Request $request, EntityManagerInterface $manager, UserPasswordEncoderInterface $encoder)
    {
        $user = new User();
        $token = new Token();

        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $hash = $encoder->encodePassword($user, $user->getPassword());

            $user->setPassword($hash);

            $user->setValidation(0);

            $manager->persist($user);
            $manager->flush();

            $tempToken = random_bytes(8);
            $token->setToken(bin2hex($tempToken));
            $token->setUser($user);

            $manager->persist($token);
            $manager->flush();

            $mail = new SendTokenByMail();
//            $mail->sendEmail($mail,$user, $token );
            return $this->redirectToRoute('email', ['email' => $user->getEmail(), 'token' => $token->getToken()]);

//            return $this->render('main/home.html.twig');
        }

        return $this->render('security/registration.html.twig', [
            'formUser' => $form->createView()
        ]);
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
