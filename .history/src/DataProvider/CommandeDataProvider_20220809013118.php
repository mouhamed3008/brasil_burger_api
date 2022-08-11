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

        $today = new \DateTime("now");
        dd($today->toString());
       
        return $this->productRepository->findByCommandeAt(date("Y-m-d"));
    //    return $this->productRepository->findBy([],["commandeAt"=>"DESC"]);
       
    }


    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool{
        return $resourceClass === Commande::class;
    }
    
}