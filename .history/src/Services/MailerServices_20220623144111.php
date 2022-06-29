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
        $email = new Email();
        $email->from("cheikhanta@gmail.com")
              ->to($user->getEmail())
              ->subject($subject)
              ->html("<h1>Bienvenue a yeumbeul burger</h1>");
        $this->mailer->send($email);
    }
}