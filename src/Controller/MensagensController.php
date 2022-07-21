<?php

namespace App\Controller;

use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MensagensController extends AbstractController
{
    
    public function MessagesLike($id, $direction, LoggerInterface $logger)
    {
        if($direction === "like"){
            $currentLike = rand(80,200);
            $logger->info("Deu like");
        }else{
            $currentLike = rand(10,20);
            $logger->info("Deu Dislike");

        }

        return $this->json([ 'likes' => $currentLike] );
    }
}
