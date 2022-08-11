<?php
namespace App\Services;

use App\Entity\Commande;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
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
           dd( $product->getProducts()->getMenu()->getProduits());
            if ($product->getProducts()->getVariety() && $product->getProducts()->getVariety()->getStock()>0) {
                if ($product->getQty() > $product->getProducts()->getVariety()->getStock()) {
                return new JsonResponse(['error'=>'Stock de Boisson insuffisant, il reste '.$product->getProducts()->getVariety()->getStock()], Response::HTTP_BAD_REQUEST);
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