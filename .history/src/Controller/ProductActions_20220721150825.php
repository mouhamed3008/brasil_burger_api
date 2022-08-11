<?php
namespace App\Controller;



use App\Entity\Product;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProductActions extends AbstractController{


    
    
    public function __invoke(Request $request,  EntityManagerInterface $manager, ProductRepository $product)
    {
      $content=json_decode( $request->getContent());
      dd($content);
      $menu = new Product();
      $menu->setLibelle($content->libelle);
      $menu->setPrix($content->prix);
      $menu->setType($content->type);
      $menu->setGestionnaire($content->gestionnaire);

         foreach ($content->menus as $menu=>$m){
          $menus = $product->find($m->produits);
          if ($menus) {
            $menu->addMenus($menus, $m->quantity);
          }
        }
        $manager->persist($menu);

      
      $manager->flush();
    }
    
}