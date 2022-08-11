<?php
namespace App\Controller;



use App\Entity\Product;
use App\Repository\TypeRepository;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProductActions extends AbstractController{


    
    
    public function __invoke(Request $request,  EntityManagerInterface $manager, ProductRepository $product, TypeRepository $type)
    {
      $content=json_decode( $request->getContent());
      dd($content);
      $type = $type->find($content->type);
      $menu = new Product();
      $menu->setLibelle($content->libelle);
      $menu->setPrix($content->prix);
      $menu->setType($type);

         foreach ($content->menus as $menu=>$m){
          $menus = $product->find($m->produits);
          if ($menus) {
            $menu->addMenus($menus, $m->quantity);
          }
        }
        $manager->persist($menu);
        $manager->flush();
      return  $this->json('Succes',201);

    }
    
}