<?php

namespace App\Controller\Backend;

use App\Entity\Categorie;
use App\Form\CategorieType;
use App\Repository\CategorieRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * Tag controller class.
 */
#[Route('/admin/categorie')]
class CategorieController extends AbstractController
{
    /**
     * Constructeur of class CategorieController.
     *
     * @param CategorieRepository $repository
     */
    public function __construct(
        private readonly CategorieRepository $repository
    ) {
    }

    /**
     * Admin list tags page.
     *
     * @return Response
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
     *
     * @param Request $request
     *
     * @return Response
     */
    #[Route('/new', name: 'app_categorie_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $categorie = new Categorie();
        $form = $this->createForm(CategorieType::class, $categorie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $categorie->setActive(false);
            $this->repository->add($categorie, true);

            return $this->redirectToRoute('app_categorie_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('Backend/Categorie/new.html.twig', [
            'categorie' => $categorie,
            'form' => $form,
        ]);
    }

    /**
     * Page for show one tag with id in parameter url.
     *
     * @param Categorie $categorie
     *
     * @return Response
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
     *
     * @param Request   $request
     * @param Categorie $categorie
     *
     * @return Response
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

        return $this->render('Backend/Categorie/edit.html.twig', [
            'categorie' => $categorie,
            'form' => $form,
        ]);
    }

    /**
     * Switch visibility in ajax for post.
     *
     * @param ?Categorie $categorie
     *
     * @return Response
     */
    #[Route('/switch/{id}', name: 'admin.categorie.switch', methods: 'GET')]
    public function switchVisibilityTag(?Categorie $categorie): JsonResponse
    {
        if (!$categorie instanceof Categorie) {
            return new JsonResponse([
                'status' => 'error',
                'message' => 'Catégorie non trouvée'
            ], 404);
        }

        $categorie->setActive(!$categorie->isActive());

        $this->repository->add($categorie, true);

        return new JsonResponse([
            'status' => 'success',
            'message' => 'Catégorie mise à jour avec succès',
            'enable' => $categorie->isActive()
        ], 201);
    }

    /**
     * Delete a tag with id paramter url.
     *
     * @param Categorie $categorie
     * @param Request   $request
     *
     * @return RedirectResponse
     */
    #[Route('/delete/{id}', name: 'app_categorie_delete', methods: 'DELETE|POST')]
    public function deleteArticle(Categorie $categorie, Request $request): RedirectResponse
    {
        /** @var string|null $token */
        $token = $request->get('_token');

        if ($this->isCsrfTokenValid('delete' . $categorie->getId(), $token)) {
            $this->repository->remove($categorie, true);
            $this->addFlash('success', 'Categorie supprimée avec succès');

            return $this->redirectToRoute('app_categorie_index');
        }

        $this->addFlash('error', 'Le token n\'est pas valide');

        return $this->redirectToRoute('app_categorie_index');
    }
}
