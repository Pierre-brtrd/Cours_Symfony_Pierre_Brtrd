<?php

namespace App\Api\Controller\Comments;

use App\Entity\Comments;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Security;

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
    ){
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
