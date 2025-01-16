<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

// class SecurityController extends AbstractController
// {
//     #[Route('/security', name: 'app_security')]
//     public function index(): Response
//     {
//         return $this->render('security/index.html.twig', [
//             'controller_name' => 'SecurityController',
//         ]);
//     }
// }

class SecurityController extends AbstractController
{
    #[Route('/logout', name: 'app_logout', methods: ['GET'])]
    public function logout(): void
    {
        // Le contrôleur ne doit pas contenir de code.
        // Symfony intercepte cette route pour gérer la déconnexion.
        throw new \LogicException('Ce point de déconnexion est intercepté par le firewall.');
    }
}



