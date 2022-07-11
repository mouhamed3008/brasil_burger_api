<?php
namespace App\Controller;


use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class LivraisonActions extends AbstractController{


    
    
    public function __invoke(Request $request,  EntityManagerInterface $manager, $data)
    {
        dd($data->getLivraison());
        
        $manager->persist($data);

      
      $manager->flush();
    }
    
}