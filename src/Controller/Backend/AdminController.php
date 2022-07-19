<?php

namespace App\Controller\Backend;

use App\Entity\Article;
use App\Form\ArticleType;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

#[Route('/admin')]
class AdminController extends AbstractController
{
    private $em;

    private $repoArticle;

    public function __construct(EntityManagerInterface $em, ArticleRepository $repoArticle)
    {
        $this->em = $em;
        $this->repoArticle = $repoArticle;
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
            $article->setUser($security->getUser());
            $this->em->persist($article);
            $this->em->flush();
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
            $this->em->persist($article);
            $this->em->flush();
            $this->addFlash('success', 'Article modifié avec succès');
            return $this->redirectToRoute('admin');
        }

        return $this->render('Backend/Article/update.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/article/delete/{id}', name: 'admin.article.delete', methods: 'DELETE|POST')]
    public function deleteArticle(int $id, Article $article, Request $request)
    {
        if ($this->isCsrfTokenValid('delete' . $article->getId(), $request->get('_token'))) {
            $this->em->remove($article);
            $this->em->flush();
            $this->addFlash('success', 'Article supprimé avec succès');

            return $this->redirectToRoute('admin');
        }

        $this->addFlash('error', 'Le token n\'est pas valide');
        return $this->redirectToRoute('admin');
    }
}
