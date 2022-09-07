<?php

namespace App\Controller\Backend;

use App\Entity\Categorie;
use App\Form\CategorieType;
use App\Repository\CategorieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Tag controller class.
 */
#[Route('/admin/categorie')]
class CategorieController extends AbstractController
{
    /**
     * Constructeur of class CategorieController.
     */
    public function __construct(
        private CategorieRepository $repository
    ) {
    }

    /**
     * Admin list tags page.
     */
    #[Route('/', name: 'app_categorie_index', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('Backend/Categorie/index.html.twig', [
            'categories' => $this->repository->findAll(),
        ]);
    }

    /**
     * Create new tag page.
     */
    #[Route('/new', name: 'app_categorie_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $categorie = new Categorie();
        $form = $this->createForm(CategorieType::class, $categorie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->repository->add($categorie, true);

            return $this->redirectToRoute('app_categorie_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('Backend/Categorie/new.html.twig', [
            'categorie' => $categorie,
            'form' => $form,
        ]);
    }

    /**
     * Page for show one tag with id in parameter url.
     */
    #[Route('/{id}', name: 'app_categorie_show', methods: ['GET'])]
    public function show(Categorie $categorie): Response
    {
        return $this->render('Backend/Categorie/show.html.twig', [
            'categorie' => $categorie,
        ]);
    }

    /**
     * Page for edit tag with id parameter url.
     */
    #[Route('/{id}/edit', name: 'app_categorie_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Categorie $categorie): Response
    {
        $form = $this->createForm(CategorieType::class, $categorie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->repository->add($categorie, true);

            return $this->redirectToRoute('app_categorie_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('Backend/Categorie/edit.html.twig', [
            'categorie' => $categorie,
            'form' => $form,
        ]);
    }

    /**
     * Delete a tag with id paramter url.
     *
     * @return void
     */
    #[Route('/delete/{id}', name: 'app_categorie_delete', methods: 'DELETE|POST')]
    public function deleteArticle(Categorie $categorie, Request $request)
    {
        if ($this->isCsrfTokenValid('delete'.$categorie->getId(), $request->get('_token'))) {
            $this->repository->remove($categorie, true);
            $this->addFlash('success', 'Categorie supprimée avec succès');

            return $this->redirectToRoute('app_categorie_index');
        }

        $this->addFlash('error', 'Le token n\'est pas valide');

        return $this->redirectToRoute('app_categorie_index');
    }
}
