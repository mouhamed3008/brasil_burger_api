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
        ProductRepository $complement, 
        TypeRepository $type , 
        EntityManagerInterface $manager, 
        TypeTailleRepository $typaTaille, 
        Request $request
        )
    {
    
        
            $types = $type->findBy(['libelle'=>["FRITES","BOISSON"]]);
            $complements = $complement->findBy(['type'=>$types, 'is_active'=>true], ['type'=>'ASC']);
            return $complements;
    }
    
}