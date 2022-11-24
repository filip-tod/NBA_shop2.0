<?php

namespace App\Controller;

use App\Entity\Oprema;
use App\Form\OpremaType;
use App\Repository\OpremaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/oprema')]
class OpremaController extends AbstractController
{
    #[Route('/', name: 'app_oprema_index', methods: ['GET'])]
    public function index(OpremaRepository $opremaRepository): Response
    {
        return $this->render('oprema/index.html.twig', [
            'opremas' => $opremaRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_oprema_new', methods: ['GET', 'POST'])]
    public function new(Request $request, OpremaRepository $opremaRepository): Response
    {
        $oprema = new Oprema();
        $form = $this->createForm(OpremaType::class, $oprema);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $opremaRepository->save($oprema, true);

            return $this->redirectToRoute('app_oprema_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('oprema/new.html.twig', [
            'oprema' => $oprema,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_oprema_show', methods: ['GET'])]
    public function show(Oprema $oprema): Response
    {
        return $this->render('oprema/show.html.twig', [
            'oprema' => $oprema,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_oprema_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Oprema $oprema, OpremaRepository $opremaRepository): Response
    {
        $form = $this->createForm(OpremaType::class, $oprema);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $opremaRepository->save($oprema, true);

            return $this->redirectToRoute('app_oprema_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('oprema/edit.html.twig', [
            'oprema' => $oprema,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_oprema_delete', methods: ['POST'])]
    public function delete(Request $request, Oprema $oprema, OpremaRepository $opremaRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$oprema->getId(), $request->request->get('_token'))) {
            $opremaRepository->remove($oprema, true);
        }

        return $this->redirectToRoute('app_oprema_index', [], Response::HTTP_SEE_OTHER);
    }
}
