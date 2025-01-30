<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\MythologyRepository; // Import du repository

use App\Entity\User;
use App\Entity\Mythology;
use App\Form\SignUpType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

use App\Form\SignInType;
use App\Repository\UserRepository;

use Symfony\Component\HttpFoundation\Session\SessionInterface;



// class SignUpController extends AbstractController
// {
//     #[Route('/sign/up', name: 'sign_up')]
//     public function index(MythologyRepository $mythologyRepository): Response
//     {
//         // return $this->render('user/sign_up.html.twig', [
//         //     'controller_name' => 'SignUpController',
//         // ]);

//         // Récupération de toutes les données de la table Mythology
//         $mythologies = $mythologyRepository->findAll();

//         // Envoi des données à la vue
//         return $this->render('user/sign_up.html.twig', [
//             'mythologies' => $mythologies,
//         ]);

//     }
    
// }







class SignUpController extends AbstractController
{
    #[Route('/sign/up', name: 'sign_up')]
    public function index(
        Request $request,
        MythologyRepository $mythologyRepository,
        EntityManagerInterface $entityManager,
        UserPasswordHasherInterface $passwordHasher,
        SessionInterface $session
    ): Response {


        // Si l'utilisateur est déjà connecté, redirige vers "member_area"
        if ($session->has('user_id')) {
            // return $this->redirectToRoute('member_area');
            return $this->redirectToRoute('/');
        }



        // Récupération des mythologies pour le champ "myth_code"
        $mythologies = $mythologyRepository->findAll();
        $choices = [];
        foreach ($mythologies as $mythology) {
            $choices[$mythology->getName() . ' (' . $mythology->getCategory() . ')'] = $mythology->getId();
        }

        // Création du formulaire
        $user = new User();
        $form = $this->createForm(SignUpType::class, $user, [
            'mythologies_choices' => $choices,
        ]);

        // Traitement du formulaire
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {



            try {


                // Récupération des données du formulaire
                $formData = $form->getData();
                $password = $form->get('password')->getData();
                $confirmPassword = $form->get('confirm_password')->getData();

                // Validation des mots de passe
                if ($password !== $confirmPassword) {
                    $this->addFlash('error', 'Les mots de passe ne correspondent pas.');
                    return $this->redirectToRoute('sign_up');
                }

                // Hashage du mot de passe
                $hashedPassword = $passwordHasher->hashPassword($user, $password);
                $user->setPassword($hashedPassword);

                $user->setAccountCreationDate(new \DateTime());


                // Associer un Myth-code (optionnel, en fonction de l'ID fourni)
                $mythologyId = $form->get('mythology')->getData();
                $mythology = $entityManager->getRepository(Mythology::class)->find($mythologyId);
                if ($mythology) { 
                    $user->setMythology($mythology->getName());
                }

                // Enregistrer l'utilisateur dans la base de données
                $entityManager->persist($user);
                $entityManager->flush();

                // Message de confirmation
                $this->addFlash('success', 'Votre compte a été créé avec succès !');
                return $this->redirectToRoute('sign_in');


            } catch (\Exception $e) {
                $this->addFlash('error', 'Compte existant !');
            }    



        }

        return $this->render('user/sign_up.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
