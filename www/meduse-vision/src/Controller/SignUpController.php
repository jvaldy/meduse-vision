<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\MythologyRepository; // Import du repository

class SignUpController extends AbstractController
{
    #[Route('/sign/up', name: 'sign_up')]
    public function index(MythologyRepository $mythologyRepository): Response
    {
        // return $this->render('user/sign_up.html.twig', [
        //     'controller_name' => 'SignUpController',
        // ]);

        // Récupération de toutes les données de la table Mythology
        $mythologies = $mythologyRepository->findAll();

        // Envoi des données à la vue
        return $this->render('user/sign_up.html.twig', [
            'mythologies' => $mythologies,
        ]);


    }

    
}
