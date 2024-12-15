<?php

// namespace App\Controller;

// use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
// use Symfony\Component\HttpFoundation\Response;
// use Symfony\Component\Routing\Annotation\Route;

// class SignInController extends AbstractController
// {
//     #[Route('/sign/in', name: 'sign_in')]
//     public function index(): Response
//     {
//         return $this->render('user/sign_in.html.twig', [
//             'controller_name' => 'SignInController',
//         ]);
//     }
// }




namespace App\Controller;

use App\Repository\MythologyRepository; // Import du repository
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SignInController extends AbstractController
{
    #[Route('/sign/in', name: 'sign_in')]
    public function index(MythologyRepository $mythologyRepository): Response
    {
        // Récupération de toutes les données de la table Mythology
        $mythologies = $mythologyRepository->findAll();

        // Envoi des données à la vue
        return $this->render('user/sign_in.html.twig', [
            'mythologies' => $mythologies,
        ]);
    }
}
