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
                    foreach($zoneC as $zon){
                        dd($zone);
                        if ($zon->getId() == $zone->getId()) {
                            $zoneC[]=$zone;
                        }

                    }
                }

               
            }
        }
        return $zoneC;
    }
    
}