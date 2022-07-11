<?php
namespace App\Controller;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProductActions extends AbstractController{


    // #[Route('/products', name: 'app_add_product')]
    public function __invoke(Request $request)
    {
        $data = \json_decode($request->getContent(), true);

       dd($data['menus']);
      foreach ($data['menus'] as $menus) {}
    }
    
}