<?php
namespace App\Controller;


use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProductActions extends AbstractController{


    // #[Route('/products', name: 'app_add_product')]
    public function __invoke($data)
    {
       dd($data);
    }
    
}