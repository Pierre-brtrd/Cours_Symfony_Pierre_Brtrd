<?php

namespace App\DataFixtures\Providers;

use App\Entity\ArticleImage;
use App\Repository\ArticleRepository;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ArticleImageProvider
{
    public function uploadImageArticle(): ArticleImage
    {
        $files = glob(realpath(dirname(__DIR__) . '/images') . '/*.*');

        $file = array_rand($files);

        $imageFile = new File($files[$file]);
        $imageName = $imageFile->getFilename();
        $imageSize = $imageFile->getSize();

        $image = new ArticleImage();
        $image->setImageFile($imageFile);
        $image->setImageName($imageName);
        $image->setImageSize($imageSize);

        return $image;
    }
}