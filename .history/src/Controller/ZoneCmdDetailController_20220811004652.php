<?php
namespace App\Controller;

use App\Repository\ZoneRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ZoneCmdDeatilController extends AbstractController{


    
    
    public function __invoke(ZoneRepository $zone)
    {
        $zones = $zone->findAll();
        $zoneC = [];
        $date = new \DateTime();

        foreach($zones as $zone){
            foreach($zone->getCommandes() as $z){
                if ($z->getCommandeAt()->format('Y-m-d') == $date->format('Y-m-d')) {
                    $zoneC[]=$zone;
                }

               
            }
        }
        return array_unique($zoneC, SORT_REGULAR);
    }
    
}