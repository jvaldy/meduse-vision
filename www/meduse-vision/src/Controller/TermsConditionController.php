<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TermsConditionController extends AbstractController
{
    #[Route('/terms_condition', name: 'terms_condition')]
    public function index(): Response
    {
        return $this->render('legal/terms_condition.html.twig', [
            'controller_name' => 'TermsConditionController',
        ]);
    }
}
