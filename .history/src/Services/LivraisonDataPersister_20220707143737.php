<?php
namespace App\Services;

use App\Entity\Product;
use App\Entity\Livraison;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RequestStack;
use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class LivraisonDataPersister implements ContextAwareDataPersisterInterface
{
 
    public function __construct(
        EntityManagerInterface $entityManager,
      
        TokenStorageInterface $token,
        UploadFileService $uploadFile,
        RequestStack $requestStack
    
    ) {
        $this->_entityManager = $entityManager;
        $this->token = $token->getToken();
        $this->uploadFile = $uploadFile;
        $this->requestStack = $requestStack;
    
  
    }

    /**
     * {@inheritdoc}
     */
    public function supports($data, array $context = []): bool
    {
        return $data instanceof Livraison;
    }

  
    public function persist($data, array $context = [])
    {

    

        
        foreach ($data->getCommandes() as $commande){
            dd($commande->getZone());
            if ($commande->getZone() != $data->getZone()) {
                return new JsonResponse(['error'=>'Veuillez selectionner des commandes d\'une meme zone'], Response::HTTP_BAD_REQUEST);
            }else{
                $commande->setStatus('Cours de livraison');
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
        $data->setIsActive(0);
        $this->entityManager->persist($data);
        $this->entityManager->flush();
    }
}