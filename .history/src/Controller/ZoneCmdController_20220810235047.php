<?php
namespace App\Controller;

use App\Repository\ZoneRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ZoneCmdController extends AbstractController{


    
    
    public function __invoke(ZoneRepository $zone)
    {
        $zones = $zone->findAll();
        $zoneC = [];
        // dd($zones);
        $date = new \DateTime();
        dump($date);

        foreach($zones as $zone){
            foreach($zone->getCommandes() as $z){
                if ($z->getCommandeAt() == $date) {
                    $zoneC[]=$zone;
                }

               
            }
        }
    }
    
}