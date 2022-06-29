<?php
namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ValidateEmailActions extends AbstractController{

    public function __invoke(Request $request, UserRepository $userR)
    {
        $token = $request->get('token');
        $user = $userR->findOneBy(['token' => $token]);
        if (!$user){
            return new JsonResponse(['error'=>'token invalide'], Response::HTTP_BAD_REQUEST);
        }
        if ($user->isIsActivate()) {
            return new JsonResponse(['message'=>'Le compte est déja activé'], Response::HTTP_BAD_REQUEST);

        }
        if ($user->getExpiredAt() < new \DateTime() ) {
            return new JsonResponse(['message'=>'clé expiré'], Response::HTTP_BAD_REQUEST);
        }
        $user->setIsActivate(true);
        
    }
    
}