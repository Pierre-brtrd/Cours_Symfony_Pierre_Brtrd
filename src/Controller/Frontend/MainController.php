<?php

namespace App\Controller\Frontend;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/', name: "home")]
    public function index(): Response
    {
        $data = [
            'prenom' => 'Pierre',
            'nom' => 'Bertrand',
            'age' => 25
        ];

        return $this->render('Home/index.html.twig', [
            'data' => $data
        ]);
    }
}
