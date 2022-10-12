<?php

namespace App\Services;

use App\Entity\Article;
use App\Entity\ArticleImage;
use App\Repository\ArticleRepository;
use Vich\UploaderBundle\Mapping\PropertyMapping;
use Vich\UploaderBundle\Naming\DirectoryNamerInterface;

class ArticleDirectoryNamer implements DirectoryNamerInterface
{
    public function __construct(
        private readonly ArticleRepository $repository,
    ){
    }

    /**
     * DirectoryNamer for article.
     *
     * @param ArticleImage $object
     *
     * @throws \Exception
     */
    public function directoryName($object, PropertyMapping $mapping): string
    {
        /*
         * @TODO do resolve path for delete file
         */
        if ( ! $object->getArticle() instanceof Article) {
            throw new \Exception('The object must be a image related to an article');
        }

        if ($object->getArticle()->getId()) {
            return $object->getArticle()->getSlug();
        }

        return self::slugify($object->getArticle()->getTitre());
    }

    /**
     * @param string $text
     *
     * @return string
     */
    private static function slugify(string $text): string
    {// replace non letter or digits by divider
        $text = preg_replace('~[^\pL\d]+~u', '-', $text);

        // transliterate
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);

        // trim
        $text = trim($text, '-');

        // remove duplicate divider
        $text = preg_replace('~-+~', '-', $text);

        // lowercase
        $text = mb_strtolower($text);

        if (empty($text)) {
            return 'n-a';
        }

        /* @var string $text */
        return $text;
    }
}
