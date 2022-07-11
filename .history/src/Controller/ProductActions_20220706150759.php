<?php
namespace App\Controller;


use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProductActions extends AbstractController{

    public function __construct(EntityManagerInterface $manager) {
        $this->manager = $manager;
    }
    


    public function __invoke(Request $request,  EntityManagerInterface $manager, $data)
    {
         foreach ($data->getMenus() as $menu){
            $menu->setProduits($menu->getProduits());
            dd($menu->setProduits($menu->getProduits()));
        }

      
      $manager->persist($data);
      $manager->flush();
    }
    
}