<?php
namespace App\Controller;


use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProductActions extends AbstractController{


    // #[Route('/products', name: 'app_add_product')]
    public function __invoke(Request $request,  EntityManagerInterface $manager, $data)
    {
        
        foreach ($data->getMenus() as $menu){
           dd($menu);

       }
        
      
      
      $manager->persist($data);
      $manager->flush();
    }
    
}