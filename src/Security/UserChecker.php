<?php

namespace App\Security;

use App\Entity\User;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserCheckerInterface;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAccountStatusException;

class UserChecker implements UserCheckerInterface
{
    public function checkPreAuth(UserInterface $user): void
    {
        if (!$user instanceof User) {
            return;
        }

        if (!$user->isVerified()) {
            throw new CustomUserMessageAccountStatusException('Votre adresse email n\'est pas vérifiée, veuillez cliquer sur le lien envoyé par email lors de votre inscription');
        }
    }

    public function checkPostAuth(UserInterface $user): void
    {
    }
}
