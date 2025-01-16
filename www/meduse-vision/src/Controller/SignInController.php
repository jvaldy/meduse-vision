<?php 

namespace App\Controller;

use App\Form\SignInType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\MythologyRepository;



// class SignInController extends AbstractController
// {
//     #[Route('/sign/in', name: 'sign_in')]
//     public function index(Request $request, UserRepository $userRepository, SessionInterface $session): Response
//     {
//         // Création du formulaire de connexion
//         $form = $this->createForm(SignInType::class);
//         $form->handleRequest($request);

//         if ($form->isSubmitted() && $form->isValid()) {
//             $data = $form->getData(); // Récupère les données du formulaire
//             $email = $data['email'];
//             $password = $data['password'];

//             // Recherche de l'utilisateur dans la base de données
//             $user = $userRepository->findOneBy(['email' => $email]);

//             if (!$user) {
//                 $this->addFlash('error', 'Utilisateur non trouvé.');
//                 return $this->redirectToRoute('sign_in');
//             }

//             // Vérification du mot de passe
//             if (!password_verify($password, $user->getPassword())) {
//                 $this->addFlash('error', 'Mot de passe incorrect.');
//                 return $this->redirectToRoute('sign_in');
//             }

//             // Création de la session utilisateur
//             $session->set('user_id', $user->getId());
//             $session->set('user_email', $user->getEmail());
//             $session->set('user_name', $user->getFirstName());

//             $this->addFlash('success', 'Connexion réussie !');
//             return $this->redirectToRoute('member_area');
//         }

//         // Envoi du formulaire à la vue
//         return $this->render('user/sign_in.html.twig', [
//             'form' => $form->createView(),
//         ]);
//     }
// }







// class SignInController extends AbstractController
// {
//     #[Route('/sign/in', name: 'sign_in')]
//     public function index(Request $request, MythologyRepository $mythologyRepository): Response
//     {
//         // Récupération des mythologies pour le champ "myth_code"
//         $mythologies = $mythologyRepository->findAll();
//         $choices = [];
//         foreach ($mythologies as $mythology) {
//             $choices[$mythology->getName() . ' (' . $mythology->getCategory() . ')'] = $mythology->getId();
//         }

//         // Création du formulaire
//         $form = $this->createForm(SignInType::class, null, [
//             'mythologies_choices' => $choices,
//         ]);

//         // Traitement du formulaire
//         $form->handleRequest($request);
//         if ($form->isSubmitted() && $form->isValid()) {
//             $data = $form->getData();

//             // Logique de connexion (authentification)
//             // Exemple : vérifier les informations avec la base de données

//             return $this->redirectToRoute('member_area'); // Redirige vers l'espace membre
//         }

//         return $this->render('user/sign_in.html.twig', [
//             'form' => $form->createView(),
//         ]);
//     }
// }








class SignInController extends AbstractController
{
    #[Route('/sign/in', name: 'sign_in')]
    public function index(
        Request $request,
        MythologyRepository $mythologyRepository,
        UserRepository $userRepository,
        SessionInterface $session
    ): Response {

        // Si l'utilisateur est déjà connecté, redirige vers "member_area"
        if ($session->has('user_id')) {
            return $this->redirectToRoute('member_area');
        }


        // Récupération des mythologies pour le champ "myth_code"
        $mythologies = $mythologyRepository->findAll();
        $choices = [];
        foreach ($mythologies as $mythology) {
            $choices[$mythology->getName() . ' (' . $mythology->getCategory() . ')'] = $mythology->getId();
        }

        // Création du formulaire de connexion
        $form = $this->createForm(SignInType::class, null, [
            'mythologies_choices' => $choices,
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData(); // Récupère les données du formulaire
            $email = $data['email'];
            $password = $data['password'];

            // Recherche de l'utilisateur dans la base de données
            $user = $userRepository->findOneBy(['email' => $email]);

            if (!$user) {
                $this->addFlash('error', 'Utilisateur non trouvé.');
                return $this->redirectToRoute('sign_in');
            }

            // Vérification du mot de passe
            if (!password_verify($password, $user->getPassword())) {
                $this->addFlash('error', 'Mot de passe incorrect.');
                return $this->redirectToRoute('sign_in');
            }

            // Création de la session utilisateur
            $session->set('user_id', $user->getId());
            $session->set('user_email', $user->getEmail());
            $session->set('user_name', $user->getUsername());

            $this->addFlash('success', 'Connexion réussie !');
            return $this->redirectToRoute('member_area');
        }

        // Envoi du formulaire à la vue
        return $this->render('user/sign_in.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
