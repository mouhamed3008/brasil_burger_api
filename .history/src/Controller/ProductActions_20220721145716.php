<?php
namespace App\Controller;



use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProductActions extends AbstractController{


    
    
    public function __invoke(Request $request,  EntityManagerInterface $manager, $data)
    {
      $content=json_decode( $request->getContent());
      dd($content);
      $menu = new Product();
      $menu->setLibelle($content->libelle);
      $menu->setPrix($content->prix);
      $menu->setType($content->type);
      $menu->setGestionnaire($content->gestionnaire);
         foreach ($data->getMenus() as $menu){
            $menu->setMenus($menu->getProduits());
        }
        $manager->persist($data);

      
      $manager->flush();
    }
    
}