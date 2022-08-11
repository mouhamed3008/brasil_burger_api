<?php
namespace App\Controller;

use App\Repository\ZoneRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ZoneCmdController extends AbstractController{


    
    
    public function __invoke(ZoneRepository $zone)
    {
        $zones = $zone->findAll();
        $zoneC = [];
        $date = new \DateTime();

        foreach($zones as $zone){
            foreach($zone->getCommandes() as $z){
                if ($z->getCommandeAt()->format('Y-m-d') == $date->format('Y-m-d')) {
                    if (!in_array($zone,$zoneC)) {
                        $zoneC[]=$zone;
                    }
                }

               
            }
        }
         return $zoneC;
        // return array_unique($zoneC, SORT_REGULAR);
    }
    
}