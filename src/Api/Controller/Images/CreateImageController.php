<?php

namespace App\Api\Controller\Images;

use App\Entity\ArticleImage;
use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

#[AsController]
final class CreateImageController extends AbstractController
{
    public function __construct(
        private ArticleRepository $repoArticle
    ) {
    }

    public function __invoke(Request $request): ArticleImage
    {
        $uploadedFile = $request->files->get('imageFile');
        $articleId = $request->get('article');

        if (!$uploadedFile) {
            throw new BadRequestHttpException('"file" is required');
        }

        if (!is_numeric($articleId)) {
            throw new BadRequestHttpException('Article id must be numeric');
        }

        $article = $this->repoArticle->find($articleId);

        $mediaObject = new ArticleImage();
        $mediaObject->setImageFile($uploadedFile);
        $mediaObject->setArticle($article);

        return $mediaObject;
    }
}
