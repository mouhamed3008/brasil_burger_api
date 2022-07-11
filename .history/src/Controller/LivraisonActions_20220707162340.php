<?php
namespace App\Controller;


use App\Repository\CommandeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class LivraisonActions extends AbstractController{


    
    
    public function __invoke(CommandeRepository $commande,  EntityManagerInterface $manager, $data)
    {
        $commandes = $commande->findByStatus("en cours");
        // dd($commandes);
        if (count($commandes) >0) {
            foreach ($commandes as $commande){
                if ($commande->getZone() == $data->getZone()) {
                    $commande->setStatus('Cours de livraison');
                    $commande->setLivraison($data);
                    $manager->persist($data);
                    $manager->flush();
                }
            }
            return new JsonResponse(['data'=>$data]);
        }else{
            return new JsonResponse(['error'=>'Pas de commande sur cette zone'], Response::HTTP_BAD_REQUEST);

        }
        

      
    }
    
}