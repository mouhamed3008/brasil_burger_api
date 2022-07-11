<?php
namespace App\Controller;


use App\Repository\CommandeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class LivraisonActions extends AbstractController{


    
    
    public function __invoke(CommandeRepository $commande,  EntityManagerInterface $manager, $data)
    {
        $commandes = $commande->findByStatus("en cours");
        // dd($commandes);
        if (count($commandes) >0) {
            foreach ($commandes as $commande){
                dd($commande->getZone());
                if ($commande->getZone() == $data->getZone()) {
                    $commande->setStatus('Cours de livraison');
                    $commande->setLivraison($data);
                }
                $manager->persist($commande);
            }
        }
        
        $manager->persist($data);

      
      $manager->flush();
    }
    
}