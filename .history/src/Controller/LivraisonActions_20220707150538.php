<?php
namespace App\Controller;


use App\Repository\CommandeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class LivraisonActions extends AbstractController{


    
    
    public function __invoke(CommandeRepository $commande,  EntityManagerInterface $manager, $data)
    {
        $commandes = $commande->findBy(['status'=>'en cours','zone_id'=>$data->getZone()]);
        
        if (count($commandes) >0) {
            foreach ($commandes as $commande){
                if ($commande->getZone() != $data->getZone()) {
                    return new JsonResponse(['error'=>'Veuillez selectionner des commandes d\'une meme zone'], Response::HTTP_BAD_REQUEST);
                }else{
                    $commande->setStatus('Cours de livraison');
                    $commande->setLivraison($data);
                }
    
            }
        }
        
        $manager->persist($data);

      
      $manager->flush();
    }
    
}