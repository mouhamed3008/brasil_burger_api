<?php
namespace App\Services;

use Doctrine\ORM\EntityManagerInterface;
use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use App\Entity\Commande;
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
        return $data instanceof Commande;
    }

  
    public function persist($data, array $context = [])
    {
        
        // dd($data->getLigneDeCommandes());
            
        foreach ($data->getLigneDeCommandes() as $product){
            if ($product->getProducts()->getVariety() && $product->getProducts()->getVariety()->getStock()<0) {
                if ($data->getQty() > $product->getProducts()->getVariety()->getStock()) {
                    # code...
                }
            }
            $product->setPrix($product->getProducts()->getPrix());
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