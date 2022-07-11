<?php
namespace App\Services;

use Doctrine\ORM\EntityManagerInterface;
use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use App\Entity\Commande;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class CommandeDataPersister implements ContextAwareDataPersisterInterface
{
    private $_entityManager;
    private $_passwordEncoder;

    public function __construct(
        EntityManagerInterface $entityManager,
        TokenStorageInterface $token
    
    ) {
        $this->_entityManager = $entityManager;
        
        $this->token = $token->getToken();
  
    }

    /**
     * {@inheritdoc}
     */
    public function supports($data, array $context = []): bool
    {
        return $data instanceof Commande ;
    }

  
    public function persist($data, array $context = [])
    {
        
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