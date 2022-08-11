<?php
namespace App\Controller;

use App\Repository\CommandeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ZoneCmdDetailController extends AbstractController{


    
    
    public function __invoke($data, CommandeRepository $cmd)
    {
       dd('ok',$data);
       $commandes = $cmd->findBy(['zone' => $data]);
       foreach ($commandes as $command){
      
       }
    }
    
}