<?php
namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ValidateEmailActions extends AbstractController{

    public function __invoke(Request $request, UserRepository $userR)
    {
        $token = $request->get('token');
        $user = $userR->findOneBy(['token' => $token]);
        if (!$user){
            return JsonResponse(['error'=>'Invalid token'], Response::HTTP_BAD_REQUEST);
        }
    }
    
}