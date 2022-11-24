<?php

namespace App\Controller;

use App\Entity\Igrac;
use App\Form\IgracType;
use App\Repository\IgracRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/igrac')]
class IgracController extends AbstractController
{
    #[Route('/', name: 'app_igrac_index', methods: ['GET'])]
    public function index(IgracRepository $igracRepository): Response
    {
        return $this->render('igrac/index.html.twig', [
            'igracs' => $igracRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_igrac_new', methods: ['GET', 'POST'])]
    public function new(Request $request, IgracRepository $igracRepository): Response
    {
        $igrac = new Igrac();
        $form = $this->createForm(IgracType::class, $igrac);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $igracRepository->save($igrac, true);

            return $this->redirectToRoute('app_igrac_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('igrac/new.html.twig', [
            'igrac' => $igrac,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_igrac_show', methods: ['GET'])]
    public function show(Igrac $igrac): Response
    {
        return $this->render('igrac/show.html.twig', [
            'igrac' => $igrac,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_igrac_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Igrac $igrac, IgracRepository $igracRepository): Response
    {
        $form = $this->createForm(IgracType::class, $igrac);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $igracRepository->save($igrac, true);

            return $this->redirectToRoute('app_igrac_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('igrac/edit.html.twig', [
            'igrac' => $igrac,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_igrac_delete', methods: ['POST'])]
    public function delete(Request $request, Igrac $igrac, IgracRepository $igracRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$igrac->getId(), $request->request->get('_token'))) {
            $igracRepository->remove($igrac, true);
        }

        return $this->redirectToRoute('app_igrac_index', [], Response::HTTP_SEE_OTHER);
    }
}
