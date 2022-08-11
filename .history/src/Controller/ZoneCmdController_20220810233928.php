<?php
namespace App\Controller;


use App\Repository\TypeRepository;
use App\Repository\ZoneRepository;

use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ZoneCmdController extends AbstractController{


    
    
    public function __invoke(ZoneRepository $zone)
    {
        
        
            $types = $type->findBy(['is_catalogue'=>1]);
            $catalogues = $catalogue->findBy(['type'=>$types, 'is_active'=>true], ['type'=>'ASC']);
            return $catalogues;
    }
    
}