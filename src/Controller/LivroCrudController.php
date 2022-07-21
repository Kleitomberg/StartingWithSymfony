<?php

namespace App\Controller;

use App\Entity\Livro;
use App\Form\LivroType;
use App\Repository\LivroRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/livro/crud')]
class LivroCrudController extends AbstractController
{
    #[Route('/', name: 'app_livro_crud_index', methods: ['GET'])]
    public function index(LivroRepository $livroRepository): Response
    {
        #dump($livroRepository->findAll());
        return $this->render('livro_crud/index.html.twig', [
            'livros' => $livroRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_livro_crud_new', methods: ['GET', 'POST'])]
    public function new(Request $request, LivroRepository $livroRepository): Response
    {
        #dump($request->request);
        #dump($livroRepository);
        $livro = new Livro();

        $form = $this->createForm(LivroType::class, $livro);
       # dump($form);
        $form->handleRequest($request);
       # dump($form);

        if ($form->isSubmitted() && $form->isValid()) {
           # dump($livro);
            $livroRepository->add($livro, true);

            return $this->redirectToRoute('app_livro_crud_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('livro_crud/new.html.twig', [
            'livro' => $livro,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_livro_crud_show', methods: ['GET'])]
    public function show(Livro $livro): Response
    {
        return $this->render('livro_crud/show.html.twig', [
            'livro' => $livro,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_livro_crud_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Livro $livro, LivroRepository $livroRepository): Response
    {
        $form = $this->createForm(LivroType::class, $livro);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $livroRepository->add($livro, true);

            return $this->redirectToRoute('app_livro_crud_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('livro_crud/edit.html.twig', [
            'livro' => $livro,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_livro_crud_delete', methods: ['POST'])]
    public function delete(Request $request, Livro $livro, LivroRepository $livroRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$livro->getId(), $request->request->get('_token'))) {
            $livroRepository->remove($livro, true);
        }

        return $this->redirectToRoute('app_livro_crud_index', [], Response::HTTP_SEE_OTHER);
    }
}
