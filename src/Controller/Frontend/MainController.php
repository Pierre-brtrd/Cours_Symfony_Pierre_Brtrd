<?php

namespace App\Controller\Frontend;

use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(ArticleRepository $repository): Response
    {
        $articles = $repository->findLatestArticleWithLimit(6);

        return $this->render('frontend/Home/index.html.twig', [
            'articles' => $articles,
            'curentPage' => 'home',
        ]);
    }
}
