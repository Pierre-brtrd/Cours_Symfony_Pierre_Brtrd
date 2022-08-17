<?php

namespace App\Controller\Frontend;

use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\Cache\ItemInterface;

class MainController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(ArticleRepository $repository, CacheInterface $cache): Response
    {
        $articles = $cache->get('home_articles_list', function (ItemInterface $item) use ($repository) {
            $item->expiresAfter(1000);

            return $repository->findLatestArticleWithLimit(6);
        });

        $response = $this->render('Frontend/Home/index.html.twig', [
            'articles' => $articles,
            'curentPage' => 'home',
        ]);

        return $response->setSharedMaxAge(1500);
    }
}
