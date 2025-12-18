<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class PrivacyController extends AbstractController
{
    #[Route('/about', name: 'app_about_us', methods: ['GET'])]
    public function aboutUs(): Response
    {
        return $this->render('privacy/about_us.html.twig', [
            'title' => 'Qui sommes-nous ?',
        ]);
    }

    #[Route('/privacy', name: 'app_privacy', methods: ['GET'])]
    public function privacy(): Response
    {
        return $this->render('privacy/privacy.html.twig', [
            'title' => 'Politique de confidentialité',
        ]);
    }

    #[Route('/cgv', name: 'app_cgv', methods: ['GET'])]
    public function cgv(): Response
    {
        return $this->render('privacy/cgv.html.twig', [
            'title' => 'Conditions Générales de Vente',
        ]);
    }

    #[Route('/cgu', name: 'app_cgu', methods: ['GET'])]
    public function cgu(): Response
    {
        return $this->render('privacy/cgu.html.twig', [
            'title' => 'Conditions Générales d\'Utilisation',
        ]);
    }
}