<?php
namespace App\Services;

use Symfony\Component\Mime\Email;

class MailerServices {
    

    public function __construct() 
    {
        
    }

   
    public function sendEmail()
    {
        $email = new Email();
        $email->from("cheikhanta@gmail.com")
              ->to("mm@gmail.com")
              ->subject("Creation de compte")
              ->html("<h1>Bienvenue a yeumbeul burger</h1>");
    }
}