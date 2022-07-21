<?php

namespace App\Controller;

use App\Entity\Livro;
use App\Form\Livro1Type;
use App\Repository\LivroRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/livro')]
class LivroController extends AbstractController
{
    #[Route('/', name: 'app_livro_index', methods: ['GET'])]
    public function index(LivroRepository $livroRepository): Response
    {
        return $this->render('livro/index.html.twig', [
            'livros' => $livroRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_livro_new', methods: ['GET', 'POST'])]
    public function new(Request $request, LivroRepository $livroRepository): Response
    {
        $livro = new Livro();
        $form = $this->createForm(Livro1Type::class, $livro);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $livroRepository->add($livro, true);

            return $this->redirectToRoute('app_livro_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('livro/new.html.twig', [
            'livro' => $livro,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_livro_show', methods: ['GET'])]
    public function show(Livro $livro): Response
    {
        return $this->render('livro/show.html.twig', [
            'livro' => $livro,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_livro_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Livro $livro, LivroRepository $livroRepository): Response
    {
        $form = $this->createForm(Livro1Type::class, $livro);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $livroRepository->add($livro, true);

            return $this->redirectToRoute('app_livro_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('livro/edit.html.twig', [
            'livro' => $livro,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_livro_delete', methods: ['POST'])]
    public function delete(Request $request, Livro $livro, LivroRepository $livroRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$livro->getId(), $request->request->get('_token'))) {
            $livroRepository->remove($livro, true);
        }

        return $this->redirectToRoute('app_livro_index', [], Response::HTTP_SEE_OTHER);
    }
}
