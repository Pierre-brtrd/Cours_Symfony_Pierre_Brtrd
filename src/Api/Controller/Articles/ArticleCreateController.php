<?php

namespace App\Api\Controller\Articles;

use App\Entity\Article;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Security;

class ArticleCreateController extends AbstractController
{
    public function __construct(
        private Security $security
    ) {
    }

    public function __invoke(Article $data)
    {
        $data->setUser($this->security->getUser());

        return $data;
    }
}
