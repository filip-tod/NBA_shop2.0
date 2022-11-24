<?php

namespace App\Controller;

use App\Entity\Kupac;
use App\Form\KupacType;
use App\Repository\KupacRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/kupac')]
class KupacController extends AbstractController
{
    #[Route('/', name: 'app_kupac_index', methods: ['GET'])]
    public function index(KupacRepository $kupacRepository): Response
    {
        return $this->render('kupac/index.html.twig', [
            'kupacs' => $kupacRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_kupac_new', methods: ['GET', 'POST'])]
    public function new(Request $request, KupacRepository $kupacRepository): Response
    {
        $kupac = new Kupac();
        $form = $this->createForm(KupacType::class, $kupac);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $kupacRepository->save($kupac, true);

            return $this->redirectToRoute('app_kupac_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('kupac/new.html.twig', [
            'kupac' => $kupac,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_kupac_show', methods: ['GET'])]
    public function show(Kupac $kupac): Response
    {
        return $this->render('kupac/show.html.twig', [
            'kupac' => $kupac,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_kupac_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Kupac $kupac, KupacRepository $kupacRepository): Response
    {
        $form = $this->createForm(KupacType::class, $kupac);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $kupacRepository->save($kupac, true);

            return $this->redirectToRoute('app_kupac_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('kupac/edit.html.twig', [
            'kupac' => $kupac,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_kupac_delete', methods: ['POST'])]
    public function delete(Request $request, Kupac $kupac, KupacRepository $kupacRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$kupac->getId(), $request->request->get('_token'))) {
            $kupacRepository->remove($kupac, true);
        }

        return $this->redirectToRoute('app_kupac_index', [], Response::HTTP_SEE_OTHER);
    }
}
