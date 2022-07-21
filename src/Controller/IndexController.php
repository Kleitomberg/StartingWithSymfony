<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class IndexController extends AbstractController{

    public function HomePage(Request $request){

        $filmes =["Harry Potter", "Percy Jackson", "Eu sou o numero 4", "Truque de Mestre", "Jumpers"];

        return $this->render('index.html.twig', [
            "filmes"=>$filmes,
            "pagina"=>"Inicio",
        ]);
    }
}