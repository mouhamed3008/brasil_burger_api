<?php
namespace App\Services;

use App\Entity\User;
use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;

class ValidateEmail implements ContextAwareDataPersisterInterface
{
  

    public function __construct(EntityManagerInterface $entityManager, Request $request) {
        $this->entityManager = $entityManager;
        $this->request = $request;
        dd($this->request);
    }

    /**
     * {@inheritdoc}
     */
    public function supports($data, array $context = []): bool
    {
        return $data instanceof User ;
    }

  
    public function persist($data, array $context = [])
    {
        $token = $this->request;
        dd($token);

        if ($data instanceof Product) {
            dd($this->token);
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