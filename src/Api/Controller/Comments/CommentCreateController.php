<?php

namespace App\Api\Controller\Comments;

use App\Entity\Comments;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * Class Api Comment Controller.
 */
class CommentCreateController extends AbstractController
{
    /**
     * @param Security $security
     */
    public function __construct(
        private readonly Security $security
    ) {
    }

    /**
     * @param Comments $data
     *
     * @return Comments
     */
    public function __invoke(Comments $data): Comments
    {
        $data->setUser($this->security->getUser());

        return $data;
    }
}
