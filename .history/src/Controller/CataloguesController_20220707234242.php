<?php
namespace App\Controller;


use App\Repository\TypeRepository;
use App\Repository\ProductRepository;
use App\Repository\CommandeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CataloguesController extends AbstractController{


    
    
    public function __invoke(ProductRepository $catalogue, TypeRepository $type , EntityManagerInterface $manager, $data, Request $request)
    {
        
            $types = $type->findByIsCatalogues(1);
            dd($types);
            $catalogues = $catalogue->findBy(['type'=>[1,2], 'is_active'=>true]);
            return $catalogues;
        
       
       
      
    }
    
}