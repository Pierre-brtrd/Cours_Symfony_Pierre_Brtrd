<?php

namespace App\Api\Controller\Comments;

use App\Entity\Comments;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Security;

class CommentCreateController extends AbstractController
{
    public function __construct(
        private Security $security
    ) {
    }

    public function __invoke(Comments $data)
    {
        $data->setUser($this->security->getUser());

        return $data;
    }
}
