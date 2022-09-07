<?php

namespace App\Controller\Backend;

use App\Data\SearchData;
use App\Entity\Article;
use App\Entity\Comments;
use App\Form\ArticleType;
use App\Form\SearchForm;
use App\Repository\ArticleRepository;
use App\Repository\CommentsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

/**
 * Article controller backend class.
 */
#[Route('/admin')]
class ArticleController extends AbstractController
{
    /**
     * Constructeur of class ArticleController.
     */
    public function __construct(
        private EntityManagerInterface $em,
        private ArticleRepository $repoArticle,
        private CommentsRepository $repoComments
    ) {
    }

    /**
     * Admin liste posts page.
     */
    #[Route('/article', name: 'admin')]
    public function adminListArticle(Request $request): Response
    {
        $data = new SearchData();
        $data->setPage($request->get('page', 1));

        $form = $this->createForm(SearchForm::class, $data);
        $form->handleRequest($request);

        $articles = $this->repoArticle->findSearch($data, false);

        if ($request->get('ajax')) {
            return new JsonResponse([
                'content' => $this->renderView('Components/Article/_articles.html.twig', [
                    'articles' => $articles,
                    'admin' => true,
                ]),
                'sorting' => $this->renderView('Components/Article/_sorting.html.twig', [
                    'articles' => $articles,
                    'admin' => true,
                ]),
                'pagination' => $this->renderView('Components/Article/_pagination.html.twig', [
                    'articles' => $articles,
                    'admin' => true,
                ]),
                'count' => $this->renderView('Components/Article/_count.html.twig', [
                    'articles' => $articles,
                    'admin' => true,
                ]),
                'pages' => ceil($articles->getTotalItemCount() / $articles->getItemNumberPerPage()),
            ]);
        }

        return $this->renderForm('Backend/Article/index.html.twig', [
            'articles' => $articles,
            'form' => $form,
        ]);
    }

    /**
     * Create new post page.
     */
    #[Route('/article/new', name: 'admin.article.new')]
    public function createArticle(Request $request, Security $security): Response
    {
        $article = new Article();

        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $article->setUser($security->getUser());
            $this->repoArticle->add($article, true);

            $this->addFlash('success', 'Article créé avec succès');

            return $this->redirectToRoute('admin');
        }

        return $this->render('Backend/Article/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * Edit post page with the id and slug url parameter.
     */
    #[Route('/article/edit/{id}-{slug}', name: 'admin.article.update')]
    public function editArticle(?Article $article, Request $request): Response
    {
        if (!$article instanceof Article) {
            $this->addFlash('error', 'Article non trouvé');

            return $this->redirectToRoute('admin');
        }

        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->repoArticle->add($article, true);
            $this->addFlash('success', 'Article modifié avec succès');

            return $this->redirectToRoute('admin');
        }

        return $this->render('Backend/Article/update.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * Switch visibility in ajax for post.
     *
     * @return void
     */
    #[Route('/article/switch/{id}', name: 'admin.article.switch', methods: 'GET')]
    public function switchVisibilityArticle(Article $article)
    {
        if ($article) {
            $article->isActive() ? $article->setActive(false) : $article->setActive(true);
            $this->repoArticle->add($article, true);

            return new Response('Visibility changed', 201);
        }

        return new Response('Article non trouvé', 404);
    }

    /**
     * Delete a post with the id param url.
     */
    #[Route('/article/delete/{id}', name: 'admin.article.delete', methods: 'DELETE|POST')]
    public function deleteArticle(Article $article, Request $request): RedirectResponse
    {
        if ($this->isCsrfTokenValid('delete'.$article->getId(), $request->get('_token'))) {
            $this->repoArticle->remove($article, true);
            $this->addFlash('success', 'Article supprimé avec succès');

            return $this->redirectToRoute('admin');
        }

        $this->addFlash('error', 'Le token n\'est pas valide');

        return $this->redirectToRoute('admin');
    }

    /**
     * Admin comments page.
     */
    #[Route('/article/{id}/comments', name: 'admin.article.comments')]
    public function adminComments(?Article $article): Response
    {
        if (!$article instanceof Article) {
            $this->addFlash('error', 'Article non trouvé');

            return $this->redirectToRoute('admin');
        }

        $comments = $this->repoComments->findByArticle($article->getId());

        if (!$comments) {
            $this->addFlash('error', 'Pas de commentaires trouvés');

            return $this->redirectToRoute('admin');
        }

        return $this->render('Backend/Article/comments.html.twig', [
            'comments' => $comments,
        ]);
    }

    /**
     * Switch the visibility of a comment.
     */
    #[Route('/comments/switch/{id}', name: 'admin.comments.switch', methods: 'GET')]
    public function switchVisibilityComment(?Comments $comment): Response
    {
        if (!$comment instanceof Comments) {
            return new Response('Commentaires non trouvé', 404);
        }

        if ($comment) {
            $comment->isActive() ? $comment->setActive(false) : $comment->setActive(true);
            $this->repoComments->add($comment, true);

            return new Response('Visibility changed', 201);
        }
    }

    /**
     * Delete a comment with the id url.
     */
    #[Route('/comment/delete/{id}', name: 'admin.comment.delete', methods: 'DELETE|POST')]
    public function deleteComment(Comments $comment, Request $request): RedirectResponse
    {
        if ($this->isCsrfTokenValid('delete'.$comment->getId(), $request->get('_token'))) {
            $this->repoComments->remove($comment, true);
            $this->addFlash('success', 'Commentaire supprimé avec succès');

            return $this->redirectToRoute('admin');
        }

        $this->addFlash('error', 'Le token n\'est pas valide');

        return $this->redirectToRoute('admin');
    }
}
