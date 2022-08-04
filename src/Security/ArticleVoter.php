<?php

namespace App\Security;

use App\Entity\Article;
use App\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class ArticleVoter extends Voter
{
    public const EDIT = 'EDIT_ARTICLE';

    protected function supports(string $attribute, $subject): bool
    {
        return
            self::EDIT === $attribute;
    }

    public function voteOnAttribute(string $attribute, $subject, TokenInterface $token): bool
    {


        $user = $token->getUser();

        if (!$user instanceof User) {
            return false;
        }

        return $subject->getUser()->getId() === $user->getId();
    }
}
