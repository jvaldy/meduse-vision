<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

// class MemberAreaController extends AbstractController
// {
//     #[Route('/member/area', name: 'app_member_area')]
//     public function index(): Response
//     {
//         return $this->render('member_area/index.html.twig', [
//             'controller_name' => 'MemberAreaController',
//         ]);
//     }
// }




// class MemberAreaController extends AbstractController
// {
//     #[Route('/member-area', name: 'member_area')]
//     public function index(): Response
//     {
//         return $this->render('index.html.twig', [
//             'controller_name' => 'MemberAreaController',
//         ]);
//     }
// }





use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class MemberAreaController extends AbstractController
{
    #[Route('/member_area', name: 'member_area')]
    public function index(SessionInterface $session): Response
    {
        // Vérification de la session utilisateur
        if (!$session->has('user_id')) {
            $this->addFlash('error', 'Vous devez être connecté pour accéder à cette page.');
            return $this->redirectToRoute('sign_in');
        }

        

        // return $this->render('member_area/index.html.twig', [
        //     'user_name' => $session->get('user_name'),
        // ]);
        return $this->render('index.html.twig', [
            'user_name' => $session->get('user_name'),
        ]);
    }
}
