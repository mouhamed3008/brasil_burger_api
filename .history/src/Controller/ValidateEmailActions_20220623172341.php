<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ValidateEmailActions extends AbstractController{

    public function __invoke(Request $request, UserRepository $user)
    {
        # code...
    }
    
}