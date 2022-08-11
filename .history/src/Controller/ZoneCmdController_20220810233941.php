<?php
namespace App\Controller;

use App\Repository\ZoneRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ZoneCmdController extends AbstractController{


    
    
    public function __invoke(ZoneRepository $zone)
    {
        
        
            $types = $type->findBy(['is_catalogue'=>1]);
            $catalogues = $catalogue->findBy(['type'=>$types, 'is_active'=>true], ['type'=>'ASC']);
            return $catalogues;
    }
    
}