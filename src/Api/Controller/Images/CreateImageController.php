<?php

namespace App\Api\Controller\Images;

use App\Entity\ArticleImage;
use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

/**
 * Class Api create Image Article.
 */
#[AsController]
final class CreateImageController extends AbstractController
{
    /**
     * @param ArticleRepository $repoArticle
     */
    public function __construct(
        private readonly ArticleRepository $repoArticle
    ){
    }

    /**
     * @param Request $request
     *
     * @return ArticleImage
     */
    public function __invoke(Request $request): ArticleImage
    {
        /** @var ?File $uploadedFile */
        $uploadedFile = $request->files->get('imageFile');
        $articleId = $request->get('article');

        if ( ! $uploadedFile) {
            throw new BadRequestHttpException('"file" is required');
        }

        if ( ! is_numeric($articleId)) {
            throw new BadRequestHttpException('Article id must be numeric');
        }

        $article = $this->repoArticle->find($articleId);

        $mediaObject = new ArticleImage();
        $mediaObject->setImageFile($uploadedFile);
        $mediaObject->setArticle($article);

        return $mediaObject;
    }
}
