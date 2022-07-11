<?php
namespace App\Controller;


use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProductActions extends AbstractController{


    
    
    public function __invoke(Request $request,  EntityManagerInterface $manager, $data)
    {
        dd($data);
         foreach ($data->getMenus() as $menu){
            $menu->setMenus($menu->getProduits());
        }
        $manager->persist($data);

      
      $manager->flush();
    }
    
}