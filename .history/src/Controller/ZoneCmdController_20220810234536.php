<?php
namespace App\Controller;

use App\Repository\ZoneRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ZoneCmdController extends AbstractController{


    
    
    public function __invoke(ZoneRepository $zone)
    {
        $zones = $zone->findAll();
        // dd($zones);

        foreach($zones as $zone){
            dd($zone->getCommandes()->getCommandeAt());
        }
    }
    
}