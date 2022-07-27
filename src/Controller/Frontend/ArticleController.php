<?php

namespace App\Controller\Frontend;

use App\Entity\Comments;
use App\Form\CommentsType;
use App\Repository\ArticleRepository;
use App\Repository\CommentsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

#[Route('/article')]
class ArticleController extends AbstractController
{
    #[Route('/{id}-{slug}', name: 'article.show')]
    public function index(
        int $id,
        string $slug,
        ArticleRepository $repo,
        Request $request,
        Security $security,
        EntityManagerInterface $em,
        CommentsRepository $repoComment
    ): Response {
        $article = $repo->findOneBy(['id' => $id, 'slug' => $slug]);

        if (!$article) {
            $this->addFlash('error', 'Article non trouvé');

            return $this->redirectToRoute('home');
        }

        $comments = $repoComment->findActiveByArticle($article->getId());

        // On instancie le commentaire vide
        $comment = new Comments();

        $form = $this->createForm(CommentsType::class, $comment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $comment->setUser($security->getUser())
                ->setArticle($article)
                ->setActive(true);

            $em->persist($comment);
            $em->flush();

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
