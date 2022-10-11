<?php

namespace App\Security;

use App\Entity\Comments;
use App\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class CommentVoter extends Voter
{
    public const EDIT = 'EDIT_COMMENT';

    /**
     * @param string $attribute
     * @param mixed  $subject
     *
     * @return bool
     */
    protected function supports(string $attribute, mixed $subject): bool
    {
        return
            self::EDIT === $attribute &&
            $subject instanceof Comments;
    }

    /**
     * @param string         $attribute
     * @param mixed          $subject
     * @param TokenInterface $token
     *
     * @return bool
     */
    public function voteOnAttribute(string $attribute, mixed $subject, TokenInterface $token): bool
    {
        $user = $token->getUser();

        if (
            ! $user instanceof User ||
            ! $subject instanceof Comments
        ) {
            return false;
        }

        /** @var User $userToTest */
        $userToTest = $subject->getUser();

        return $userToTest->getId() === $user->getId();
    }
}
