<?php

// src/Controller/EpisodeProgressController.php

namespace App\Controller;

use App\Entity\EpisodeMaker;
use App\Form\EpisodeMakerType;
use App\Repository\EpisodeMakerRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

#[Route('/tool_emaker')]
class EpisodeMakerController extends AbstractController
{
    #[Route('/', name: 'episode_index')]
    public function index(EpisodeMakerRepository $repository, SessionInterface $session): Response
    {
        $userName = $session->get('user_name');
        $episodes = $repository->findBy(['createdBy' => $userName]);

        return $this->render('tool_emaker/list.html.twig', [
            'episodes' => $episodes,
        ]);
    }

    #[Route('/new', name: 'episode_new')]
    public function new(Request $request, EntityManagerInterface $entityManager, SessionInterface $session): Response
    {
        $episode = new EpisodeMaker();
        $form = $this->createForm(EpisodeMakerType::class, $episode);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userName = $session->get('user_name');
            $episode->setCreatedBy($userName);

            $entityManager->persist($episode);
            $entityManager->flush();
            $this->addFlash('success', 'Suivi ajouté avec succès !');

            return $this->redirectToRoute('episode_index');
        }

        return $this->render('tool_emaker/form.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/edit/{id}', name: 'episode_edit')]
    public function edit(
        int $id,
        Request $request,
        EpisodeMakerRepository $repository,
        EntityManagerInterface $entityManager,
        SessionInterface $session
    ): Response {
        $userName = $session->get('user_name');
        $episode = $repository->findOneBy(['id' => $id, 'createdBy' => $userName]);

        if (!$episode) {
            $this->addFlash('error', 'Accès refusé ou épisode introuvable.');
            return $this->redirectToRoute('episode_index');
        }

        $form = $this->createForm(EpisodeMakerType::class, $episode);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            $this->addFlash('success', 'Suivi mis à jour avec succès !');

            return $this->redirectToRoute('episode_index');
        }

        return $this->render('tool_emaker/form.html.twig', [
            'form' => $form->createView(),
            'episode' => $episode,
        ]);
    }

    #[Route('/delete/{id}', name: 'episode_delete', methods: ['POST'])]
    public function delete(
        Request $request,
        int $id,
        EpisodeMakerRepository $repository,
        EntityManagerInterface $entityManager,
        SessionInterface $session
    ): Response {
        $userName = $session->get('user_name');
        $episode = $repository->findOneBy(['id' => $id, 'createdBy' => $userName]);

        if (!$episode) {
            $this->addFlash('error', 'Accès refusé ou épisode introuvable.');
            return $this->redirectToRoute('episode_index');
        }

        if ($this->isCsrfTokenValid('delete' . $id, $request->request->get('_token'))) {
            $entityManager->remove($episode);
            $entityManager->flush();
            $this->addFlash('success', 'Suivi supprimé avec succès.');
        }

        return $this->redirectToRoute('episode_index');
    }
}
