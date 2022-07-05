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
        $catalogue = [];
        $catalogue['burger'] = $this->productRepository->findBy(['is_active'=>1]);
        $catalogue['menus'] = $this->menuRepository->findAll();
        $presentation =  json_encode($catalogue, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);

        $response = new Response($catalogue);
        $response->headers->set('Content-Type', 'application/json');
    
        return $response;
        return json_encode($catalogue);
    }


    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool{
        return $resourceClass === Catalogue::class;
    }
    
}