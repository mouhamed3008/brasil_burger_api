<?php
namespace App\Services;

use Symfony\Component\Mime\Email;
use Symfony\Component\Mailer\MailerInterface;

class MailerServices {
    

    public function __construct(MailerInterface $mailer) 
    {
        $this->mailer = $mailer;
    }

   
    public function sendEmail($user, $subject="Creation de compte")
    {
        $content = "<h1>Bienvenue $user->getNom( a yeumbeul burger</h1>";
        $email = new Email();
        $email->from("cheikhanta@gmail.com")
              ->to($user->getEmail())
              ->subject($subject)
              ->html();
        $this->mailer->send($email);
    }
}