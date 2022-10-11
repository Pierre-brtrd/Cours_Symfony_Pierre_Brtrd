<?php

namespace App\Controller\Frontend;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

/**
 * User controller frontend class.
 */
#[Route('/compte')]
class UserController extends AbstractController
{
    /**
     * Constructor of class UserController.
     */
    public function __construct(
        private readonly Security $security
    ){
    }

    /**
     * Show account user connect.
     */
    #[Route('', name: 'compte')]
    public function show(): Response
    {
        $user = $this->security->getUser();

        return $this->render('Frontend/User/show.html.twig', [
            'user' => $user,
        ]);
    }

    /**
     * Edit account user.
     */
    #[Route('/edit-account', name: 'front_user_edit', methods: ['GET', 'POST'])]
    public function edit(
        Request $request,
        UserRepository $userRepository
    ): Response{
        /** @var User $user */
        $user = $this->security->getUser();

        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userRepository->add($user, true);

            return $this->redirectToRoute('compte', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('Backend/User/edit.html.twig', [
            'user' => $user,
            'form' => $form,
            'title_heading' => 'Editez votre profil',
        ]);
    }
}
