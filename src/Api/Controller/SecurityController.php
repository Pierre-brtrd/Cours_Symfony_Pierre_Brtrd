<?php

namespace App\Api\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class Api SecurityController.
 */
class SecurityController extends AbstractController
{
    /**
     * @return JsonResponse
     */
    public function apiLogin(): JsonResponse
    {
        /** @var User $user */
        $user = $this->getUser();

        return $this->json([
            'username' => $user->getUserIdentifier(),
            'roles' => $user->getRoles(),
        ]);
    }
}
