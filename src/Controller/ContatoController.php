<?php 

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContatoController extends AbstractController{

        public function ContatoPage(){


            return $this-> render('contato.html.twig',);

        }
}