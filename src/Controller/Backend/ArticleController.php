<?php

namespace App\Controller\Backend;

use App\Entity\Article;
use App\Form\ArticleType;
use App\Repository\ArticleRepository;
use App\Repository\CommentsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

#[Route('/admin')]
class ArticleController extends AbstractController
{
    public function __construct(
        private EntityManagerInterface $em,
        private ArticleRepository $repoArticle,
        private CommentsRepository $repoComments
    ) {
    }

    #[Route('/article', name: 'admin')]
    public function adminListArticle()
    {
        $articles = $this->repoArticle->findAll();

        return $this->render('Backend/Article/index.html.twig', [
            'articles' => $articles,
        ]);
    }

    #[Route('/article/new', name: 'admin.article.new')]
    public function createArticle(Request $request, Security $security): Response
    {
        $article = new Article();

        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $images = [];

            foreach ($form->get('articleImages') as $image) {
                $images[] = $image;
            }

            $article->setUser($security->getUser());
            $this->repoArticle->add($article, true);

            foreach ($images as $image) {
                $article->addArticleImage($image->getData());
            }
            $this->repoArticle->add($article, true);

            $this->addFlash('success', 'Article créé avec succès');

            return $this->redirectToRoute('admin');
        }

        return $this->render('Backend/Article/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/article/edit/{id}-{slug}', name: 'admin.article.update')]
    public function editArticle(int $id, string $slug, Request $request): Response
    {
        $article = $this->repoArticle->find($id);

        if (!$article) {
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

    #[Route('/article/delete/{id}', name: 'admin.article.delete', methods: 'DELETE|POST')]
    public function deleteArticle(Article $article, Request $request)
    {
        if ($this->isCsrfTokenValid('delete' . $article->getId(), $request->get('_token'))) {
            $this->repoArticle->remove($article, true);
            $this->addFlash('success', 'Article supprimé avec succès');

            return $this->redirectToRoute('admin');
        }

        $this->addFlash('error', 'Le token n\'est pas valide');

        return $this->redirectToRoute('admin');
    }

    #[Route('/article/{id}-{slug}/comments', name: 'admin.article.comments')]
    public function adminComments(int $id, string $slug)
    {
        $comments = $this->repoComments->findByArticle($id, $slug);

        if (!$comments) {
            $this->addFlash('error', 'Pas de commentaires trouvés');

            return $this->redirectToRoute('admin');
        }

        return $this->render('backend/article/comments.html.twig', [
            'comments' => $comments,
        ]);
    }

    #[Route('/comments/switch/{id}', name: 'admin.comments.switch', methods: 'GET')]
    public function switchVisibilityComment(int $id)
    {
        $comment = $this->repoComments->find($id);

        if ($comment) {
            $comment->isActive() ? $comment->setActive(false) : $comment->setActive(true);
            $this->repoComments->add($comment, true);

            return new Response('Visibility changed', 201);
        }

        return new Response('Commentaires non trouvé', 400);
    }
}
