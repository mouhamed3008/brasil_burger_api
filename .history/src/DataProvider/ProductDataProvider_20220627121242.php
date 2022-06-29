<?php
namespace App\DataProvider;

use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use ApiPlatform\Core\DataProvider\ContextAwareCollectionDataProviderInterface;


class ProductDataProvider implements ContextAwareCollectionDataProviderInterface, RestrictedDataProviderInterface {


    /**
     * {@inheritdoc}
     */
    public function getCollection(string $resourceClass, string $operationName = null, array $context = []){

    }


    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool{
        
    }
    
}