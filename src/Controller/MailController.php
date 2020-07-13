<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;

class MailController extends AbstractController
{
    /**
     * @Route("/email/{email}/{token}", name="email")
     * @param MailerInterface $mailer
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws TransportExceptionInterface
     */
    public function sendEmail(MailerInterface $mailer,Request $request)
    {
        $routeParameters = $request->attributes->get('_route_params');
        $email = (new Email())
            ->from('no-reply@snowtricks.com')
            ->to($routeParameters['email'])
            ->subject('Valider votre Compte snowtricks !')
            ->text('Pour valider votre compte, veuillez cliquez sur le bouton ci-dessous')
            ->html('<a class="btn btn-success offset-2 col-8" href="http://127.0.0.1:8000/validateUser/'.$routeParameters['email']
.'/'.$routeParameters['token'].'">Valider votre compte !</a>');

        $mailer->send($email);
        return $this->redirectToRoute('home');
    }
}
