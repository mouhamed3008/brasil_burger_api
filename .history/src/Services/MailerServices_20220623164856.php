<?php
namespace App\Services;

use Twig\Environment;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mailer\MailerInterface;

class MailerServices {
    

    public function __construct(MailerInterface $mailer, Environment $environment) 
    {
        $this->mailer = $mailer;
        $this->environment = $environment;
    }

   
    public function sendEmail($user, $subject="Creation de compte")
    {
        $email = new Email();
        $email->from("cheikhanta@gmail.com")
              ->to($user->getEmail())
              ->subject($subject)
              ->html(
                $this->environment->render('email/registration.html.twig',[
                    'user' => $user,
                    'subject' => $subject
                ])
              );
        $this->mailer->send($email);
    }
}