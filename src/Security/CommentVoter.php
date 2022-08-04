<?php

namespace App\Security;

use App\Entity\Comments;
use App\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class CommentVoter extends Voter
{
    public const EDIT = 'EDIT_COMMENT';

    protected function supports(string $attribute, $subject): bool
    {
        return
            self::EDIT === $attribute &&
            $subject instanceof Comments;
    }

    public function voteOnAttribute(string $attribute, $subject, TokenInterface $token): bool
    {
        $user = $token->getUser();

        if (
            !$user instanceof User ||
            !$subject instanceof Comments
        ) {
            return false;
        }

        return $subject->getUser()->getId() === $user->getId();
    }
}
