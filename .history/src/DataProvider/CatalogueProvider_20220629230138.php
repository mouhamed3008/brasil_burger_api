<?php
namespace App\DataProvider;

use App\Entity\Catalogue;
use App\Repository\MenuRepository;
use App\Repository\ProductRepository;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use ApiPlatform\Core\DataProvider\ContextAwareCollectionDataProviderInterface;


class CatalogueProvider implements ContextAwareCollectionDataProviderInterface, RestrictedDataProviderInterface {

    public function __construct(ProductRepository $productRepository, MenuRepository $menuRepository, SerializerInterface $serializer)
    {
        $this->productRepository = $productRepository;
        $this->menuRepository = $menuRepository;
        $this->serializer = $serializer;
    }

    /**
     * {@inheritdoc}
     */
    public function getCollection(string $resourceClass, string $operationName = null, array $context = []){
        $catalogue = [];
        $catalogue['burger'] = $this->productRepository->findBy(['is_active'=>1]);
        $catalogue['menus'] = $this->menuRepository->findAll();



        $productSerialized = $this->serializer->serialize($catalogue, 'json');
        return json_decode($productSerialized;
    }


    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool{
        return $resourceClass === Catalogue::class;
    }
    
}