<?php
namespace App\DataProvider;

use App\Entity\Commande;
use App\Repository\CommandeRepository;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use ApiPlatform\Core\DataProvider\ContextAwareCollectionDataProviderInterface;

class CommandeDataProvider implements ContextAwareCollectionDataProviderInterface, RestrictedDataProviderInterface {

    public function __construct(CommandeRepository $productRepository)
    {
        $this->productRepository = $productRepository;

    }

    /**
     * {@inheritdoc}
     */
    public function getCollection(string $resourceClass, string $operationName = null, array $context = []){
       
       return $this->productRepository->findBy([],["commandeAt"=>"ASC"]);
       
    }


    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool{
        return $resourceClass === Commande::class;
    }
    
}