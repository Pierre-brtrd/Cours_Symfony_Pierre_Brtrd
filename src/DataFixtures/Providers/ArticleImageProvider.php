<?php

namespace App\DataFixtures\Providers;

use App\Entity\ArticleImage;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;

use function dirname;

class ArticleImageProvider
{
    public function uploadImageArticle(): ArticleImage
    {
        /** @var array<string> $files */
        $files = glob(realpath(dirname(__DIR__).'/images/Articles/').'/*.*');

        $file = array_rand($files);

        $imageFile = new File($files[$file]);
        $uploadFile = new UploadedFile($imageFile, $imageFile->getFilename());

        $image = new ArticleImage();
        $image->setImageFile($uploadFile);

        return $image;
    }

    public function uploadImageUser(string $file = 'default.png'): UploadedFile
    {
        /** @var array<string> $files */
        $file = realpath(dirname(__DIR__).'/images/'.$file);

        $imageFile = new File($file);

        return new UploadedFile($imageFile, $imageFile->getFilename());
    }
}
