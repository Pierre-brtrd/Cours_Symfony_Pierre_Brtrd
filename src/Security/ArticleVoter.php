<?php

namespace App\Security;

use App\Entity\Article;
use App\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Security;

class ArticleVoter extends Voter
{
    public const EDIT = 'EDIT_ARTICLE';

    public function __construct(
        private Security $security
    ) {
    }

    protected function supports(string $attribute, $subject): bool
    {
        return
            self::EDIT === $attribute &&
            $subject instanceof Article;
    }

    public function voteOnAttribute(string $attribute, $subject, TokenInterface $token): bool
    {
        $user = $token->getUser();

        if (
            !$user instanceof User ||
            !$subject instanceof Article
        ) {
            return false;
        }

        return
            $subject->getUser()->getId() === $user->getId() ||
            $this->security->isGranted('ROLE_ADMIN');
    }
}
