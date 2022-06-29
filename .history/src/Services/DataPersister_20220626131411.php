<?php
namespace App\Services;

use App\Entity\User;
use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class DataPersister implements ContextAwareDataPersisterInterface
{
    private $_entityManager;
    private $_passwordEncoder;

    public function __construct(
        EntityManagerInterface $entityManager,
        UserPasswordHasherInterface $passwordEncoder,
        MailerServices $mailer,
        TokenStorageInterface $token
    
    ) {
        $this->_entityManager = $entityManager;
        $this->_passwordEncoder = $passwordEncoder;
        $this->mailer = $mailer;
        $this->token = $token->getToken();
  
    }

    /**
     * {@inheritdoc}
     */
    public function supports($data, array $context = []): bool
    {
        return $data instanceof User or $data instanceof Product;
    }

  
    public function persist($data, array $context = [])
    {
        dd($this->token->getUser());
        if ($data instanceof Product) {
            if ($this->token->getUser()) {
                $data->setGestionnaire($this->token->getUser());
            }
        }elseif ($data instanceof User) {
            if ($data->getPlainPassword()) {
                $data->setPassword(
                    $this->_passwordEncoder->hashPassword(
                        $data,
                        $data->getPlainPassword()
                    )
                );
    
                $data->eraseCredentials();
                $this->mailer->sendEmail($data);
            }
        }
        
      

        $this->_entityManager->persist($data);
        $this->_entityManager->flush();
      
    }

    /**
     * {@inheritdoc}
     */
    public function remove($data, array $context = [])
    {
       
    }
}