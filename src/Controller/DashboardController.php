<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractController
{
    #[Route('/dashboard', name: 'app_dashboard')]
    public function index(): Response
    {
        // Récupérez les données pertinentes de la base de données pour afficher dans le tableau de bord
        $activityData = []; // Exemple de données d'activité physique
        $sleepData = [];    // Exemple de données de sommeil
        $nutritionData = []; // Exemple de données de nutrition

        return $this->render('dashboard.html.twig', [
            'activityData' => $activityData,
            'sleepData' => $sleepData,
            'nutritionData' => $nutritionData,
            // Ajoutez d'autres données ici si nécessaire
        ]);
    }
}
