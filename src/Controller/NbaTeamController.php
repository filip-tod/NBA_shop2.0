<?php

namespace App\Controller;

use App\Entity\NbaTeam;
use App\Form\NbaTeamType;
use App\Repository\NbaTeamRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/nba/team')]
class NbaTeamController extends AbstractController
{
    #[Route('/', name: 'app_nba_team_index', methods: ['GET'])]
    public function index(NbaTeamRepository $nbaTeamRepository): Response
    {
        return $this->render('nba_team/index.html.twig', [
            'nba_teams' => $nbaTeamRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_nba_team_new', methods: ['GET', 'POST'])]
    public function new(Request $request, NbaTeamRepository $nbaTeamRepository): Response
    {
        $nbaTeam = new NbaTeam();
        $form = $this->createForm(NbaTeamType::class, $nbaTeam);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $nbaTeamRepository->save($nbaTeam, true);

            return $this->redirectToRoute('app_nba_team_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('nba_team/new.html.twig', [
            'nba_team' => $nbaTeam,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_nba_team_show', methods: ['GET'])]
    public function show(NbaTeam $nbaTeam): Response
    {
        return $this->render('nba_team/show.html.twig', [
            'nba_team' => $nbaTeam,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_nba_team_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, NbaTeam $nbaTeam, NbaTeamRepository $nbaTeamRepository): Response
    {
        $form = $this->createForm(NbaTeamType::class, $nbaTeam);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $nbaTeamRepository->save($nbaTeam, true);

            return $this->redirectToRoute('app_nba_team_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('nba_team/edit.html.twig', [
            'nba_team' => $nbaTeam,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_nba_team_delete', methods: ['POST'])]
    public function delete(Request $request, NbaTeam $nbaTeam, NbaTeamRepository $nbaTeamRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$nbaTeam->getId(), $request->request->get('_token'))) {
            $nbaTeamRepository->remove($nbaTeam, true);
        }

        return $this->redirectToRoute('app_nba_team_index', [], Response::HTTP_SEE_OTHER);
    }
}
