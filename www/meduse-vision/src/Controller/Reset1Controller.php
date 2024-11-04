<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class Reset1Controller extends AbstractController
{
    #[Route('/reset1', name: 'reset1')]
    public function index(): Response
    {
        return $this->render('user/password_reset_1.html.twig', [
            'controller_name' => 'Reset1Controller',
        ]);
    }
}
