<?php
namespace App\Controller;


use App\Repository\CommandeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class LivraisonActions extends AbstractController{


    
    
    public function __invoke(CommandeRepository $commande,  EntityManagerInterface $manager, $data)
    {
        $commandes = $commande->findBy(['status'=>'en cours','zone_id'=>$data->getZone()]);
        dd($data->getZone());
        
        $manager->persist($data);

      
      $manager->flush();
    }
    
}