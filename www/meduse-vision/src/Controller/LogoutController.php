<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class LogoutController extends AbstractController
{
    #[Route('/logout', name: 'logout', methods: ['GET'])]
    public function logout(): void
    {
        // Ce contrôleur est intercepté par Symfony pour gérer la déconnexion.
        throw new \LogicException('Ce point de déconnexion est intercepté par le firewall.');
    }
}
