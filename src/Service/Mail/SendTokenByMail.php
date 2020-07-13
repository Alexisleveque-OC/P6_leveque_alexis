<?php


namespace App\Service\Mail;


use App\Entity\Token;
use App\Entity\User;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class SendTokenByMail
{
    /**
     * @param MailerInterface $mailer
     * @throws TransportExceptionInterface
     */
    public function sendEmail(MailerInterface $mailer,User $user,Token $token)
    {

        $email = (new Email())
            ->from('no-reply@snowtricks.com')
            ->to($user->getEmail())
            ->subject('Valider votre Compte snowtricks !')
            ->text('Pour valider votre compte, veuillez cliquez sur le bouton ci-dessous')
            ->html('<a class="btn btn-success offset-2 col-8" href="http://127.0.0.1:8000/validateUser/'.$user->getId()
                .'/'.$token->getToken().'">Valider votre compte !</a>');

        $mailer->send($email);
    }


}