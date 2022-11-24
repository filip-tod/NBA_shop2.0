<?php

namespace App\Controller;

use App\Entity\Kosarica;
use App\Form\KosaricaType;
use App\Repository\KosaricaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/kosarica')]
class KosaricaController extends AbstractController
{
    #[Route('/', name: 'app_kosarica_index', methods: ['GET'])]
    public function index(KosaricaRepository $kosaricaRepository): Response
    {
        return $this->render('kosarica/index.html.twig', [
            'kosaricas' => $kosaricaRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_kosarica_new', methods: ['GET', 'POST'])]
    public function new(Request $request, KosaricaRepository $kosaricaRepository): Response
    {
        $kosarica = new Kosarica();
        $form = $this->createForm(KosaricaType::class, $kosarica);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $kosaricaRepository->save($kosarica, true);

            return $this->redirectToRoute('app_kosarica_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('kosarica/new.html.twig', [
            'kosarica' => $kosarica,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_kosarica_show', methods: ['GET'])]
    public function show(Kosarica $kosarica): Response
    {
        return $this->render('kosarica/show.html.twig', [
            'kosarica' => $kosarica,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_kosarica_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Kosarica $kosarica, KosaricaRepository $kosaricaRepository): Response
    {
        $form = $this->createForm(KosaricaType::class, $kosarica);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $kosaricaRepository->save($kosarica, true);

            return $this->redirectToRoute('app_kosarica_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('kosarica/edit.html.twig', [
            'kosarica' => $kosarica,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_kosarica_delete', methods: ['POST'])]
    public function delete(Request $request, Kosarica $kosarica, KosaricaRepository $kosaricaRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$kosarica->getId(), $request->request->get('_token'))) {
            $kosaricaRepository->remove($kosarica, true);
        }

        return $this->redirectToRoute('app_kosarica_index', [], Response::HTTP_SEE_OTHER);
    }
}
