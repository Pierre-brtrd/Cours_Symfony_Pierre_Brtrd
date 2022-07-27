<?php

namespace App\Controller\Frontend;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

class UserController extends AbstractController
{
    public function __construct(
        private Security $security,
        private UserRepository $repo
    ) {
    }

    #[Route('/compte', name: 'compte')]
    public function show(): Response
    {
        $user = $this->security->getUser();

        return $this->render('frontend/user/show.html.twig', [
            'user' => $user,
        ]);
    }
}
