<?php
namespace App\Services;

use Symfony\Component\Mime\Email;
use Symfony\Component\Mailer\MailerInterface;

class MailerServices {
    

    public function __construct(MailerInterface $mailer, Environment $environment) 
    {
        $this->mailer = $mailer;
    }

   
    public function sendEmail($user, $subject="Creation de compte")
    {
        $email = new Email();
        $email->from("cheikhanta@gmail.com")
              ->to($user->getEmail())
              ->subject($subject)
              ->html($content);
        $this->mailer->send($email);
    }
}