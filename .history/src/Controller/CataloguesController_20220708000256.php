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
        
            $types = $type->findBy(['is_catalogue'=>1]);
            $catalogues = $catalogue->findBy(['type'=>$types, 'is_active'=>true]);
            return $catalogues;
        
       
       
      
    }
    
}