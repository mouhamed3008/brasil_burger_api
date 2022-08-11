<?php
namespace App\Controller;


use App\Repository\LivraisonRepository;
use Doctrine\ORM\EntityManagerInterface;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class LivraisonPutController extends AbstractController{


    
    
    public function __invoke(LivraisonRepository $livraison , EntityManagerInterface $manager, $id)
    {
        $livraisons = $livraison->find($id);

     
        foreach ($livraisons->getCommandes() as $com) {
            $com->setStatus('payer');
        }
        $$livraisons->setIsDisponible(0);        
        $manager->persist($livraisons);
       $manager->flush();
    }
    
}