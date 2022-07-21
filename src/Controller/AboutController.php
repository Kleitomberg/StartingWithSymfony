<?php 

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AboutController extends AbstractController{

    public function AboutPage($slug){

        dump($slug);
        return $this-> render('aboutus.html.twig',[
            "pagina"=>"Quem Somos",
            "parametro"=> $slug
        ]);
    }
}