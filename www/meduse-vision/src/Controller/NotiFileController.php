<?php

namespace App\Controller;

use App\Entity\NotiFile;
use App\Form\NotiFileType;
use App\Repository\NotiFileRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\Exception\FileException;


use Symfony\Component\HttpFoundation\BinaryFileResponse;

#[Route('/notifile')]
class NotiFileController extends AbstractController
{
    #[Route('/', name: 'notifile_index')]
    public function index(NotiFileRepository $repository): Response
    {
        $files = $repository->findBy([], ['createdAt' => 'DESC']);

        return $this->render('notifile/index.html.twig', [
            'files' => $files
        ]);
    }

    #[Route('/new', name: 'notifile_new')]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $file = new NotiFile();
        $form = $this->createForm(NotiFileType::class, $file);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $uploadedFile = $form['file']->getData();
            if ($uploadedFile) {
                $newFilename = uniqid() . '.' . $uploadedFile->guessExtension();
                try {
                    $uploadedFile->move($this->getParameter('uploads_directory'), $newFilename);
                    $file->setFileName($newFilename);
                } catch (FileException $e) {
                    $this->addFlash('error', 'Erreur lors de l\'upload du fichier.');
                }
            }

            $entityManager->persist($file);
            $entityManager->flush();
            $this->addFlash('success', 'Fichier ajouté avec succès !');

            return $this->redirectToRoute('notifile_index');
        }

        return $this->render('notifile/form.html.twig', [
            'form' => $form->createView()
        ]);
    }


    #[Route('/notifile/download/{id}', name: 'notifile_download')]
    public function download(int $id, NotiFileRepository $repository): Response
    {
        $file = $repository->find($id);

        if (!$file || !$file->getFileName()) {
            throw $this->createNotFoundException('Le fichier demandé est introuvable.');
        }

        $filePath = $this->getParameter('uploads_directory') . '/' . $file->getFileName();

        if (!file_exists($filePath)) {
            throw $this->createNotFoundException('Le fichier n\'existe pas sur le serveur.');
        }

        return $this->file($filePath);
    }










    

    #[Route('/show/{id}', name: 'notifile_show')]
    public function show(int $id, NotiFileRepository $repository): Response
    {
        $file = $repository->find($id);

        if (!$file) {
            throw $this->createNotFoundException('Le fichier demandé est introuvable.');
        }

        return $this->render('notifile/show.html.twig', [
            'file' => $file
        ]);
    }




    #[Route('/edit/{id}', name: 'notifile_edit')]
    public function edit(int $id, Request $request, NotiFileRepository $repository, EntityManagerInterface $entityManager): Response
    {
        $file = $repository->find($id);

        if (!$file) {
            throw $this->createNotFoundException('Fichier introuvable.');
        }

        $form = $this->createForm(NotiFileType::class, $file);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            $this->addFlash('success', 'Fichier mis à jour avec succès !');

            return $this->redirectToRoute('notifile_index');
        }

        return $this->render('notifile/form.html.twig', [
            'form' => $form->createView(),
            'file' => $file
        ]);
    }

    #[Route('/delete/{id}', name: 'notifile_delete', methods: ['POST'])]
    public function delete(int $id, Request $request, NotiFileRepository $repository, EntityManagerInterface $entityManager): Response
    {
        $file = $repository->find($id);

        if (!$file) {
            $this->addFlash('error', 'Le fichier demandé n\'existe pas.');
            return $this->redirectToRoute('notifile_index');
        }

        if ($this->isCsrfTokenValid('delete' . $id, $request->request->get('_token'))) {
            // Supprimer le fichier du serveur
            $filePath = $this->getParameter('uploads_directory') . '/' . $file->getFileName();
            if (file_exists($filePath)) {
                unlink($filePath);
            }

            $entityManager->remove($file);
            $entityManager->flush();
            $this->addFlash('success', 'Fichier supprimé avec succès.');
        } else {
            $this->addFlash('error', 'Token CSRF invalide.');
        }

        return $this->redirectToRoute('notifile_index');
    }


}
