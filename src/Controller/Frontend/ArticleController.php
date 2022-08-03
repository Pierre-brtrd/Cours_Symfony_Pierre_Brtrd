<?php

namespace App\Controller\Frontend;

use App\Data\SearchData;
use App\Entity\Comments;
use App\Form\CommentsType;
use App\Form\SearchForm;
use App\Repository\ArticleRepository;
use App\Repository\CommentsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

#[Route('/article')]
class ArticleController extends AbstractController
{
    public function __construct(
        private ArticleRepository $repo,
        private CommentsRepository $repoComment
    ) {
    }

    #[Route('/liste', name: "article.index")]
    public function index(Request $request)
    {
        $data = new SearchData();
        $data->setPage($request->get('page', 1));

        $form = $this->createForm(SearchForm::class, $data);
        $form->handleRequest($request);

        $articles = $this->repo->findSearch($data);

        return $this->renderForm('frontend/article/index.html.twig', [
            'articles' => $articles,
            'form' => $form,
            'curentPage' => 'articles',
        ]);
    }


    #[Route('/details/{id}-{slug}', name: 'article.show')]
    public function show(
        int $id,
        string $slug,
        Security $security,
        Request $request
    ): Response {
        $article = $this->repo->findOneBy(['id' => $id, 'slug' => $slug]);

        if (!$article) {
            $this->addFlash('error', 'Article non trouvé');

            return $this->redirectToRoute('home');
        }

        $comments = $this->repoComment->findActiveByArticle($article->getId());

        // On instancie le commentaire vide
        $comment = new Comments();

        $form = $this->createForm(CommentsType::class, $comment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $comment->setUser($security->getUser())
                ->setArticle($article)
                ->setActive(true);

            $this->repoComment->add($comment, true);

            $this->addFlash('success', 'Votre commentaire a été posté avec succès');

            return $this->redirectToRoute('article.show', [
                'id' => $article->getId(),
                'slug' => $article->getSlug(),
            ], 301);
        }

        return $this->renderForm('frontend/article/show.html.twig', [
            'article' => $article,
            'form' => $form,
            'comments' => $comments,
        ]);
    }
}
