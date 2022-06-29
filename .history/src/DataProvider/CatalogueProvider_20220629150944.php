<?php
namespace App\DataProvider;

use App\Entity\Catalogue;
use App\Repository\MenuRepository;
use App\Repository\TypeRepository;
use App\Repository\ProductRepository;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use ApiPlatform\Core\DataProvider\ContextAwareCollectionDataProviderInterface;


class CatalogueProvider implements ContextAwareCollectionDataProviderInterface, RestrictedDataProviderInterface {

    public function __construct(ProductRepository $productRepository, TypeRepository $typeRepository)
    {
        $this->productRepository = $productRepository;
        $this->ty = $ty;
    }

    /**
     * {@inheritdoc}
     */
    public function getCollection(string $resourceClass, string $operationName = null, array $context = []){
        // return $this->productRepository->findBy(['is_active'=>1]);
        return $context[]=$this->menuRepository->findAll();
        // return $context;
    }


    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool{
        return $resourceClass === Catalogue::class;
    }
    
}