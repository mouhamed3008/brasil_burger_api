<?php
namespace App\Controller;


use App\Repository\TypeRepository;
use App\Repository\ProductRepository;

use App\Repository\TypeTailleRepository;
use Doctrine\ORM\EntityManagerInterface;

use App\Repository\LigneDeCommandeRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ComplementController extends AbstractController{


    
    
    public function __invoke(
        ProductRepository $product, 
        TypeRepository $type , 
        TypeTailleRepository $typeTaille, 
        Request $request,
        LigneDeCommandeRepository $ligne
        )
    {
            $complements=[];
    
        
            $boissons = $ligne->findAll();
            $types = $type->findBy(['libelle'=>"FRITES"]);
            $frites = $product->findBy(['type'=>$types]);
            $complements = [$boissons,$frites];
            return $complements;
    }
    
}