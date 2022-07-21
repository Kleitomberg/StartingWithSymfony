<?php

namespace App\Controller;

use App\Entity\Autor;
use App\Form\AutorType;
use App\Repository\AutorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/autor/crud')]
class AutorCrudController extends AbstractController
{
    #[Route('/', name: 'app_autor_crud_index', methods: ['GET'])]
    public function index(AutorRepository $autorRepository): Response
    {
        return $this->render('autor_crud/index.html.twig', [
            'autors' => $autorRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_autor_crud_new', methods: ['GET', 'POST'])]
    public function new(Request $request, AutorRepository $autorRepository): Response
    {
        $autor = new Autor();
        $form = $this->createForm(AutorType::class, $autor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $autorRepository->add($autor, true);

            return $this->redirectToRoute('app_autor_crud_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('autor_crud/new.html.twig', [
            'autor' => $autor,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_autor_crud_show', methods: ['GET'])]
    public function show(Autor $autor): Response
    {
        return $this->render('autor_crud/show.html.twig', [
            'autor' => $autor,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_autor_crud_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Autor $autor, AutorRepository $autorRepository): Response
    {
        $form = $this->createForm(AutorType::class, $autor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $autorRepository->add($autor, true);

            return $this->redirectToRoute('app_autor_crud_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('autor_crud/edit.html.twig', [
            'autor' => $autor,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_autor_crud_delete', methods: ['POST'])]
    public function delete(Request $request, Autor $autor, AutorRepository $autorRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$autor->getId(), $request->request->get('_token'))) {
            $autorRepository->remove($autor, true);
        }

        return $this->redirectToRoute('app_autor_crud_index', [], Response::HTTP_SEE_OTHER);
    }
}
