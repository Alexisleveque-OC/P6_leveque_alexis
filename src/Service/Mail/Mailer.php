<?php


namespace App\Service\Mail;


use App\Entity\Token;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Twig\Environment;

class Mailer
{
    /**
     * @var MailerInterface
     */
    private $mailer;
    /**
     * @var Environment
     */
    private $twig;

    public function __construct(MailerInterface $mailer, Environment $twig)
    {
        $this->mailer = $mailer;
        $this->twig = $twig;
    }


    /**
     * @param Token $token
     * @throws TransportExceptionInterface
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function sendUserTokenMail(Token $token)
    {

        $body = $this->twig->render("mail/validateToken.html.twig", [
            'token' => $token
        ]);

        $email = (new Email())
            ->from('no-reply@snowtricks.com')
            ->to($token->getUser()->getEmail())
            ->subject('Valider votre Compte snowtricks !')
            ->html($body);

        $this->mailer->send($email);
    }

    public function sendResetPassword(Token $token)
    {
        $body = $this->twig->render("mail/ResetPasswordToken.html.twig", [
            'token' => $token
        ]);

        $email = (new Email())
            ->from('no-reply@snowtricks.com')
            ->to($token->getUser()->getEmail())
            ->subject('Valider votre Compte snowtricks !')
            ->html($body);

        $this->mailer->send($email);

}

}