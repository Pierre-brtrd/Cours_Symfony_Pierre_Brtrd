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
    public function index(
        ArticleRepository $repository,
        PaginatorInterface $paginator,
        Request $request
    ): Response {
        $query = $repository->createQueryListActiveArticle();

        $articles = $paginator->paginate(
            $query, /* query NOT result */
            $request->query->getInt('page', 1), /* page number */
            6 /* limit per page */
        );

        return $this->render('frontend/Home/index.html.twig', [
            'articles' => $articles,
            'curentPage' => 'home',
        ]);
    }
}
