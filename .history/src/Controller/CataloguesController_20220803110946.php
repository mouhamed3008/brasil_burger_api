<?php
namespace App\Controller;


use App\Repository\TypeRepository;
use App\Repository\ProductRepository;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CataloguesController extends AbstractController{


    
    
    public function __invoke(ProductRepository $catalogue, TypeRepository $type , EntityManagerInterface $manager, $data, Request $request)
    {
        // dd($request);
        
            $types = $type->findBy(['is_catalogue'=>1]);
            $catalogues = $catalogue->findBy(['type'=>$types, 'is_active'=>true], ['type'=>'ASC']);
            return $catalogues;
    }
    
}