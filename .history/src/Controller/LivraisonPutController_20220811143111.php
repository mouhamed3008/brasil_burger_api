<?php
namespace App\Controller;


use App\Repository\LivraisonRepository;
use Doctrine\ORM\EntityManagerInterface;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class LivraisonPutController extends AbstractController{


    
    
    public function __invoke(LivraisonRepository $livraison , EntityManagerInterface $manager, $id)
    {
        $livraisons = $livraison->find($id);

        $livreur = $livraisons->getLivreurs();
        $commandes = $livraisons->getCommandes();
        dd($livreur);
        
       
    }
    
}