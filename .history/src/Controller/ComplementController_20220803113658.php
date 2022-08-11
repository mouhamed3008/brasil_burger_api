<?php
namespace App\Controller;


use App\Repository\TypeRepository;
use App\Repository\ProductRepository;

use App\Repository\TypeTailleRepository;
use Doctrine\ORM\EntityManagerInterface;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ComplementController extends AbstractController{


    
    
    public function __invoke(
        ProductRepository $product, 
        TypeRepository $type , 
        EntityManagerInterface $manager, 
        TypeTailleRepository $typeTaille, 
        Request $request
        )
    {
        $complements=[];
    
        
            $boissons = $type->findAll();
            $frites = $product->findBy(['type'=>"FRITES"]);
            $complements = [$boissons];
            return $complements;
    }
    
}