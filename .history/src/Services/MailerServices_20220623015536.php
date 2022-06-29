<?php
namespace App\Service;

use Symfony\Component\Mime\Email;
use Symfony\Component\Mailer\MailerInterface;


class MailerService{


    private $mailer;

    public function __construct(MailerInterface $mailer){
        $this->mailer = $mailer;
    }
    
    public function sendEmail($to='mouha712@gmail.com', $content='<p>See Twig integration for better HTML integration!</p>', $subject='salut')
    {
        $email = (new Email())
            ->from('diengmameanta508@gmail.com')
            ->to($to)
            ->subject($subject)
            ->html($content);
        $this->mailer->send($email);
    }
}