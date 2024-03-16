<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\ActivitePhysique; // Ajout de l'importation de la classe ActivitePhysique
use App\Form\ActivitePhysiqueType;
use App\Form\RegistrationFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class RegistrationController extends AbstractController
{
    #[Route('/register', name: 'app_register')]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            $entityManager->persist($user);
            $entityManager->flush();

            // do anything else you need here, like send an email

            return $this->redirectToRoute('app_home');
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }

    #[Route('/activite-physique', name: 'app_users_activite_physique', methods: ['GET', 'POST'])]
    public function saisieActivitePhysique(Request $request, EntityManagerInterface $entityManager): Response
    {
        $activitePhysique = new ActivitePhysique();
        $form = $this->createForm(ActivitePhysiqueType::class, $activitePhysique);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Enregistrer les données dans la base de données
            $entityManager->persist($activitePhysique);
            $entityManager->flush();

            // Rediriger l'utilisateur vers une autre page ou afficher un message de réussite
            return $this->redirectToRoute('app_dashboard');
        }

        return $this->render('registration/saisie_activite_physique.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
