<?php

namespace App\Controller\Frontend;

use App\Repository\ArticleRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(ArticleRepository $repository): Response
    {
        $articles = $repository->findLatestArticleWithLimit(6);

        /*$articles = $paginator->paginate(
            $query, 
            $request->query->getInt('page', 1),
            6 
        );*/

        return $this->render('frontend/Home/index.html.twig', [
            'articles' => $articles,
            'curentPage' => 'home',
        ]);
    }
}
