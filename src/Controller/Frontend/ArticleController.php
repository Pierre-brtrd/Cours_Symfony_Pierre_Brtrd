<?php

namespace App\Controller\Frontend;

use App\Data\SearchData;
use App\Entity\Article;
use App\Entity\Comments;
use App\Entity\User;
use App\Form\CommentsType;
use App\Form\SearchForm;
use App\Repository\ArticleRepository;
use App\Repository\CommentsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

/**
 * Article controller Fontend class.
 */
class ArticleController extends AbstractController
{
    /**
     * Construtor of class ArticleController.
     */
    public function __construct(
        private readonly ArticleRepository $repo,
        private readonly CommentsRepository $repoComment
    ) {
    }

    /**
     * Page liste posts frontend.
     */
    #[Route('/article/liste', name: 'article.index')]
    public function index(Request $request): Response|JsonResponse
    {
        $data = new SearchData();

        /** @var ?int $page */
        $page = $request->get('page', 1);
        $data->setPage($page);

        $form = $this->createForm(SearchForm::class, $data);
        $form->handleRequest($request);

        $articles = $this->repo->findSearch($data);

        if ($request->get('ajax')) {
            return new JsonResponse([
                'content' => $this->renderView('Components/Article/_articles.html.twig', [
                    'articles' => $articles,
                ]),
                'sorting' => $this->renderView('Components/Article/_sorting.html.twig', [
                    'articles' => $articles,
                ]),
                'pagination' => $this->renderView('Components/Article/_pagination.html.twig', [
                    'articles' => $articles,
                ]),
                'count' => $this->renderView('Components/Article/_count.html.twig', [
                    'articles' => $articles,
                ]),
                'pages' => ceil($articles->getTotalItemCount() / $articles->getItemNumberPerPage()),
            ]);
        }

        return $this->render('Frontend/Article/index.html.twig', [
            'articles' => $articles,
            'form' => $form,
            'curentPage' => 'articles',
        ]);
    }

    /**
     * Page detail of post frontend.
     */
    #[Route('/article/details/{slug}', name: 'article.show')]
    public function show(
        ?Article $article,
        Security $security,
        Request $request
    ): Response {
        if (!$article instanceof Article) {
            $this->addFlash('error', 'Article non trouvé');

            return $this->redirectToRoute('home');
        }

        /** @var int $articleId */
        $articleId = $article->getId();

        $comments = $this->repoComment->findByArticle($articleId);

        // On instancie le commentaire vide
        $comment = new Comments();

        $form = $this->createForm(CommentsType::class, $comment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var User $user */
            $user = $security->getUser();
            $comment->setUser($user)
                ->setArticle($article)
                ->setActive(true);

            $this->repoComment->add($comment, true);

            $this->addFlash('success', 'Votre commentaire a été posté avec succès');

            return $this->redirectToRoute('article.show', [
                'id' => $article->getId(),
                'slug' => $article->getSlug(),
            ], 301);
        }

        return $this->render('Frontend/Article/show.html.twig', [
            'article' => $article,
            'form' => $form,
            'comments' => $comments,
        ]);
    }
}
