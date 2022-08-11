<?php
namespace App\Controller;

use App\Repository\CommandeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ZoneCmdDetailController extends AbstractController{


    
    
    public function __invoke($id, CommandeRepository $cmd)
    {
        dd($id);
        $today = new \DateTime();
       $commandes = $cmd->findBy(['zone' => $data]);
        $todCmd = [];

       foreach ($commandes as $command){
        if ($command->getCommandeAt()->format('Y-m-d') == $today->format('Y-m-d')){
            $todCmd[]=$command;
        }
       }

       return array_unique($todCmd, SORT_REGULAR);

    }
    
}