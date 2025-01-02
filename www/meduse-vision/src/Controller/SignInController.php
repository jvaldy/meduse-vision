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

use App\Entity\User;
use App\Form\SignInType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;




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





// class SignInController extends AbstractController
// {
//     #[Route('/sign/in', name: 'sign_in')]
//     public function index(Request $request, MythologyRepository $mythologyRepository, EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordHasher): Response
//     {
//         // Récupération des mythologies pour le champ "myth_code"
//         $mythologies = $mythologyRepository->findAll();
//         $choices = [];
//         foreach ($mythologies as $mythology) {
//             $choices[$mythology->getName() . ' (' . $mythology->getCategory() . ')'] = $mythology->getId();
//         }

//         // Création du formulaire en passant les choix au FormType
//         $form = $this->createForm(SignInType::class, null, [
//             'mythologies_choices' => $choices,
//         ]);

//         // Traitement du formulaire
//         $form->handleRequest($request);
//         if ($form->isSubmitted() && $form->isValid()) {
//             $data = $form->getData();

//             // Création de l'utilisateur
//             $user = new User();
//             $user->setEmail($data['email']);
//             $user->setPassword(
//                 $passwordHasher->hashPassword($user, $data['password'])
//             );

//             // Associer le myth-code
//             $mythology = $entityManager->getRepository(Mythology::class)->find($data['myth_code']);
//             if ($mythology) {
//                 $user->setMythology($mythology->getName());
//             }

//             // Sauvegarde en base de données
//             $entityManager->persist($user);
//             $entityManager->flush();

//             // Message de confirmation
//             $this->addFlash('success', 'Votre compte a été créé avec succès !');

//             return $this->redirectToRoute('sign_in');
//         }

//         return $this->render('user/sign_in.html.twig', [
//             'form' => $form->createView(),
//         ]);
//     }
// }
