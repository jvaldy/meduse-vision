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

        // Données simulées (à récupérer de la BDD si nécessaire)
        $outils = [
            [
                'nom' => 'Outil 1',
                'description' => 'Description rapide de l\'outil 1.',
                'image' => 'https://via.placeholder.com/100',
                'lien' => '#',
            ],
            [
                'nom' => 'Outil 22',
                'description' => 'Description rapide de l\'outil 2.',
                'image' => 'https://via.placeholder.com/100',
                'lien' => '#',
            ],
            [
                'nom' => 'Outil 3',
                'description' => 'Description rapide de l\'outil 3.',
                'image' => 'https://via.placeholder.com/100',
                'lien' => '#',
            ],
            [
                'nom' => 'Outil 4',
                'description' => 'Description rapide de l\'outil 4.',
                'image' => 'https://via.placeholder.com/100',
                'lien' => '#',
            ],
            [
                'nom' => 'Outil 5',
                'description' => 'Description rapide de l\'outil 5.',
                'image' => 'https://via.placeholder.com/100',
                'lien' => '#',
            ],
            [
                'nom' => 'Outil 6',
                'description' => 'Description rapide de l\'outil 6.',
                'image' => 'https://via.placeholder.com/100',
                'lien' => '#',
            ],
            [
                'nom' => 'Outil 7',
                'description' => 'Description rapide de l\'outil 7.',
                'image' => 'https://via.placeholder.com/100',
                'lien' => '#',
            ],
        ];

        // return $this->render('terms_condition.html.twig', [
        //     'outils' => $outils,
        // ]);

        

        // return $this->render('member_area/index.html.twig', [
        //     'user_name' => $session->get('user_name'),
        // ]);
        return $this->render('index.html.twig', [
            'user_name' => $session->get('user_name'),'outils' => $outils,
        ]);
    }
}
