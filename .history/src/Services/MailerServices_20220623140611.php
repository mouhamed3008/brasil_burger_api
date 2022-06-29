<?php
namespace App\Services;

use Symfony\Component\Mime\Email;
use Symfony\Component\Mailer\MailerInterface;

class MailerServices {
    

    public function __construct(MailerInterface $mailer) 
    {
        $this->mailer = $mailer;
    }

   
    public function sendEmail()
    {
        $email = new Email();
        $email->from("cheikhanta@gmail.com")
              ->to("mm@gmail.com")
              ->subject("Creation de compte")
              ->html("<h1>Bienvenue a yeumbeul burger</h1>");
        $mailer = new MailerInterface();
        $this->mailer->send($email);
    }
}