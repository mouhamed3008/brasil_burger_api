<?php
namespace App\DataProvider;

use App\Repository\ProductRepository;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use ApiPlatform\Core\DataProvider\ContextAwareCollectionDataProviderInterface;
use App\Entity\Commande;

class CommandeDataProvider implements ContextAwareCollectionDataProviderInterface, RestrictedDataProviderInterface {

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;

    }

    /**
     * {@inheritdoc}
     */
    public function getCollection(string $resourceClass, string $operationName = null, array $context = []){
       
       $context[] = $this->productRepository->findBy(['commande_at'=>date('Y-m-d H:i:s')]);
        return $context;
    }


    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool{
        return $resourceClass === Commande::class;
    }
    
}