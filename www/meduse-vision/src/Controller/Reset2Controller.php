<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class Reset2Controller extends AbstractController
{
    #[Route('/reset2', name: 'reset2')]
    public function index(): Response
    {
        return $this->render('user/password_reset_2.html.twig', [
            'controller_name' => 'Reset2Controller',
        ]);
    }
}
