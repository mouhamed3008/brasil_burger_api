<?php
namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ValidateEmailActions extends AbstractController{



    public function __invoke($data)
    {
       dd($data);
    }
    
}