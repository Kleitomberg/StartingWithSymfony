<?php

namespace App\Controller;

use App\Entity\Livro;


use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;




class LivrosController extends AbstractController{

   

    public function AddLivroPage(ManagerRegistry $doctrine): Response
    {


        $entityManager = $doctrine->getManager();
        if ( isset( $_POST["titulo"] )&& isset( $_POST["autor"] )&&isset( $_POST["ano"] )&&isset( $_POST["resumo"] )    ) {

            $titulo = $_POST["titulo"];
            $autor = $_POST["autor"];
            $ano = $_POST["ano"];
            $resumo = $_POST["resumo"];  
     
        

        $livro = new Livro();
        $livro->setTitulo($titulo);
        $livro->setAutor($autor);
        $livro->setAno($ano);
        $livro->setResumo($resumo);


        
        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $entityManager->persist($livro);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();
        
        
        return new Response(' Livro Salvo com id '.$livro->getId());
    }

        return $this->render("livros/create.html.twig");
    }
    
}