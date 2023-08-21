<?php

namespace App\Api\Controller\Articles;

use App\Entity\Article;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * Class Api Article Create Controller.
 */
class ArticleCreateController extends AbstractController
{
    /**
     * @param Security $security
     */
    public function __construct(
        private readonly Security $security
    ) {
    }

    /**
     * @param Article $data
     *
     * @return Article
     */
    public function __invoke(Article $data): Article
    {
        $data->setUser($this->security->getUser());

        return $data;
    }
}
