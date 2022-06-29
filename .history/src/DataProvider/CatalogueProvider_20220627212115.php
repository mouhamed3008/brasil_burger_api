<?php
namespace App\DataProvider;

use App\Entity\Catalogue;
use App\Repository\MenuRepository;
use App\Repository\ProductRepository;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use ApiPlatform\Core\DataProvider\ContextAwareCollectionDataProviderInterface;


class CatalogueProvider implements ContextAwareCollectionDataProviderInterface, RestrictedDataProviderInterface {

    public function __construct(ProductRepository $productRepository, MenuRepository $menuRepository)
    {
        $this->productRepository = $productRepository;
        $this->menuRepository = $menuRepository;
    }

    /**
     * {@inheritdoc}
     */
    public function getCollection(string $resourceClass, string $operationName = null, array $context = []){
        $context[]=$this->productRepository->findBy(['is_active'=>1]);
        $context[]=$this->menuRepository->findAll();
        return $context;
    }


    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool{
        return $resourceClass === Catalogue::class;
    }
    
}