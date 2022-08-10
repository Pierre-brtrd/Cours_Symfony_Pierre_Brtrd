<?php

namespace App\Controller\Frontend;

use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route(
        '/{_locale<%app.supported_locales%>}',
        defaults: ['_locale<%locale_en%>'],
        name: 'home.switch.locale'
    )]
    #[Route('/', name: 'home')]
    public function index(ArticleRepository $repository): Response
    {
        $articles = $repository->findLatestArticleWithLimit(6);

        return $this->render('Frontend/Home/index.html.twig', [
            'articles' => $articles,
            'curentPage' => 'home',
        ]);
    }
}
