<?php

namespace App\Controller\Backend;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * User controller class.
 */
#[Route('/admin/user')]
class UserController extends AbstractController
{
    /**
     * Page admin index Users.
     *
     * @param UserRepository $userRepository
     *
     * @return Response
     */
    #[Route('', name: 'app_user_index', methods: ['GET'])]
    public function index(UserRepository $userRepository): Response
    {
        return $this->render('Backend/User/index.html.twig', [
            'users' => $userRepository->findAll(),
        ]);
    }

    /**
     * Page admin edit user with id paramter url.
     *
     * @param Request        $request
     * @param User           $user
     * @param UserRepository $userRepository
     *
     * @return Response
     */
    #[Route('/{id}/edit', name: 'app_user_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, User $user, UserRepository $userRepository): Response
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userRepository->add($user, true);

            return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('Backend/User/edit.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    /**
     * Delete a user with id paramter url.
     *
     * @param Request        $request
     * @param User           $user
     * @param UserRepository $userRepository
     *
     * @return Response
     */
    #[Route('/{id}', name: 'app_user_delete', methods: ['POST'])]
    public function delete(Request $request, User $user, UserRepository $userRepository): Response
    {
        /** @var string|null $token */
        $token = $request->get('_token');

        if ($this->isCsrfTokenValid('delete'.$user->getId(), $token)) {
            $userRepository->remove($user, true);
        }

        return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
    }
}
