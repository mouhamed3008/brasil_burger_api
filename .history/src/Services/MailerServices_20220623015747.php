<?php
namespace App\Service;

use App\Entity\User;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mailer\MailerInterface;


class MailerService{


    private $mailer;

    public function __construct(MailerInterface $mailer){
        $this->mailer = $mailer;
    }
    

    /**
     * Envoyer des email
     *
     * @param User $user
     * @param string $content
     * @param string $subject
     * @return void
     */
    public function sendEmail($user, $content='<p>See Twig integration for better HTML integration!</p>', $subject='salut')
    {
        $from = 'diengmameanta508@gmail.com';
        $email = (new Email())
            ->from($from)
            ->to($to)
            ->subject($subject)
            ->html($content);
        $this->mailer->send($email);
    }
}