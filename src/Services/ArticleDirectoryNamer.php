<?php

namespace App\Services;

use App\Entity\ArticleImage;
use App\Repository\ArticleRepository;
use Vich\UploaderBundle\Mapping\PropertyMapping;
use Vich\UploaderBundle\Naming\DirectoryNamerInterface;

class ArticleDirectoryNamer implements DirectoryNamerInterface
{
    public function __construct(
        private ArticleRepository $repository
    ) {
    }

    /**
     * DirectoryNamer for article
     *
     * @param ArticleImage $object
     * @param PropertyMapping $mapping
     * @return string
     */
    public function directoryName($object, PropertyMapping $mapping): string
    {
        $articleInDb = $this->repository->find($object->getArticle()->getId() ?: 0);

        if (
            $object->getArticle()->getSlug() ||
            $articleInDb->getSlug() === $object->getArticle()->getSlug()
        ) {
            return $object->getArticle()->getSlug();
        }

        $dir = self::slugify($object->getArticle()->getTitre());

        return $dir;
    }

    private static function slugify($text, string $divider = '-')
    {
        // replace non letter or digits by divider
        $text = preg_replace('~[^\pL\d]+~u', $divider, $text);

        // transliterate
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);

        // trim
        $text = trim($text, $divider);

        // remove duplicate divider
        $text = preg_replace('~-+~', $divider, $text);

        // lowercase
        $text = strtolower($text);

        if (empty($text)) {
            return 'n-a';
        }

        return $text;
    }
}