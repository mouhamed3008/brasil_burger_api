<?php
namespace App\Controller;


use App\Repository\CommandeRepository;
use App\Repository\LivraisonRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class LivraisonPutController extends AbstractController{


    
    
    public function __invoke(LivraisonRepository $livraison , EntityManagerInterface $manager, $id)
    {
        $commandes = $livraison->findByStatus("en cours");
       
    }
    
}