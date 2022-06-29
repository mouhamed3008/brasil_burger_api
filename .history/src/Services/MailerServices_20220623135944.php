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
    }
}