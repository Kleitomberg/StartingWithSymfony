<?php 

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AboutController extends AbstractController{

    public function AboutPage(){

        return $this-> render('aboutus.html.twig',);
    }
}