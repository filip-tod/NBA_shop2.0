<?php

namespace App\Controller;

use App\Entity\Dostava;
use App\Form\DostavaType;
use App\Repository\DostavaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/dostava')]
class DostavaController extends AbstractController
{
    #[Route('/', name: 'app_dostava_index', methods: ['GET'])]
    public function index(DostavaRepository $dostavaRepository): Response
    {
        return $this->render('dostava/index.html.twig', [
            'dostavas' => $dostavaRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_dostava_new', methods: ['GET', 'POST'])]
    public function new(Request $request, DostavaRepository $dostavaRepository): Response
    {
        $dostava = new Dostava();
        $form = $this->createForm(DostavaType::class, $dostava);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $dostavaRepository->save($dostava, true);

            return $this->redirectToRoute('app_dostava_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('dostava/new.html.twig', [
            'dostava' => $dostava,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_dostava_show', methods: ['GET'])]
    public function show(Dostava $dostava): Response
    {
        return $this->render('dostava/show.html.twig', [
            'dostava' => $dostava,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_dostava_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Dostava $dostava, DostavaRepository $dostavaRepository): Response
    {
        $form = $this->createForm(DostavaType::class, $dostava);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $dostavaRepository->save($dostava, true);

            return $this->redirectToRoute('app_dostava_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('dostava/edit.html.twig', [
            'dostava' => $dostava,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_dostava_delete', methods: ['POST'])]
    public function delete(Request $request, Dostava $dostava, DostavaRepository $dostavaRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$dostava->getId(), $request->request->get('_token'))) {
            $dostavaRepository->remove($dostava, true);
        }

        return $this->redirectToRoute('app_dostava_index', [], Response::HTTP_SEE_OTHER);
    }
}
