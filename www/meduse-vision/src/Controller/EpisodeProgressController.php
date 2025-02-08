<?php

namespace App\Controller;

use App\Entity\EpisodeProgress;
use App\Repository\EpisodeProgressRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


use App\Form\EpisodeProgressType;

#[Route('/episode')]
class EpisodeProgressController extends AbstractController
{
    #[Route('/', name: 'episode_index')]
    public function index(EpisodeProgressRepository $repository): Response
    {
        return $this->render('episode/index.html.twig', [
            'episodes' => $repository->findAll(),
        ]);
    }

    #[Route('/new', name: 'episode_new')]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $episode = new EpisodeProgress();
        $form = $this->createForm(EpisodeProgressType::class, $episode);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($episode);
            $entityManager->flush();
            $this->addFlash('success', 'Suivi ajouté avec succès !');

            return $this->redirectToRoute('episode_index');
        }

        return $this->render('episode/form.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/edit/{id}', name: 'episode_edit')]
    public function edit(
        int $id,
        Request $request,
        EpisodeProgressRepository $repository,
        EntityManagerInterface $entityManager
    ): Response {
        $episode = $repository->find($id);

        if (!$episode) {
            $this->addFlash('error', 'Le suivi demandé n\'existe pas.');
            return $this->redirectToRoute('episode_index');
        }

        $form = $this->createForm(EpisodeProgressType::class, $episode);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            $this->addFlash('success', 'Suivi mis à jour avec succès !');

            return $this->redirectToRoute('episode_index');
        }

        return $this->render('episode/form.html.twig', [
            'form' => $form->createView(),
            'episode' => $episode,
        ]);
    }

    #[Route('/delete/{id}', name: 'episode_delete', methods: ['POST'])]
    public function delete(
        Request $request,
        int $id,
        EpisodeProgressRepository $repository,
        EntityManagerInterface $entityManager
    ): Response {
        $episode = $repository->find($id);

        if (!$episode) {
            $this->addFlash('error', 'Le suivi demandé n\'existe pas.');
            return $this->redirectToRoute('episode_index');
        }

        if ($this->isCsrfTokenValid('delete' . $id, $request->request->get('_token'))) {
            $entityManager->remove($episode);
            $entityManager->flush();
            $this->addFlash('success', 'Suivi supprimé avec succès.');
        } else {
            $this->addFlash('error', 'Token CSRF invalide.');
        }

        return $this->redirectToRoute('episode_index');
    }
}
