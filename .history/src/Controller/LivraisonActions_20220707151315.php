<?php
namespace App\Controller;


use App\Repository\CommandeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class LivraisonActions extends AbstractController{


    
    
    public function __invoke(CommandeRepository $commande,  EntityManagerInterface $manager, $data)
    {
        $commandes = $commande->findBy(['status'=>'en cours']);
        
        if (count($commandes) >0) {
            foreach ($commandes as $commande){
                if ($commande->getZone() == $data->getZone()) {
                    # code...
                }
                    $commande->setStatus('Cours de livraison');
                    $commande->setLivraison($data);
    
                    $manager->persist($commande);
            }
        }
        
        $manager->persist($data);

      
      $manager->flush();
    }
    
}