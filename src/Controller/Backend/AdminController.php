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

#[Route('/admin')]
class AdminController extends AbstractController
{
    #[Route('/article', name: 'admin')]
    public function adminListArticle(ArticleRepository $repos)
    {
        $articles = $repos->findAll();

        return $this->render('Backend/Article/index.html.twig', [
            'articles' => $articles,
        ]);
    }

    #[Route('/article/new', name: 'admin.article.new')]
    public function createArticle(Request $request, EntityManagerInterface $em): Response
    {
        $article = new Article();

        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($article);
            $em->flush();
            $this->addFlash('success', 'Artcile créé avec succès');
            return $this->redirectToRoute('admin');
        }

        return $this->render('Backend/Article/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
