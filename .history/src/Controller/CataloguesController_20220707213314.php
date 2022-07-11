<?php
namespace App\Controller;


use App\Repository\ProductRepository;
use App\Repository\CommandeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CataloguesController extends AbstractController{


    
    
    public function __invoke(ProductRepository $commande,  EntityManagerInterface $manager, $data)
    {
        

      
    }
    
}