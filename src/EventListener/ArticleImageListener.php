<?php

namespace App\EventListener;

use Exception;
use App\Entity\Article;
use Doctrine\ORM\Events;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpKernel\KernelInterface;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsEntityListener;

#[AsEntityListener(event: Events::preUpdate, method: 'preUpdate', entity: Article::class)]
#[AsEntityListener(event: Events::postRemove, method: 'postRemove', entity: Article::class)]
class ArticleImageListener
{
    public function __construct(
        private KernelInterface $kernel
    ) {
    }

    public function preUpdate(Article $article, PreUpdateEventArgs $event): void
    {
        if ($event->hasChangedField('title')) {
            foreach ($article->getArticleImages() as $image) {
                if (!$image->getImageFile()) {
                    $path = $this->kernel->getProjectDir()
                        . '/public/images/articles/'
                        . $event->getEntityChangeSet()['slug'][0]
                        . '/' . $image->getImageName();

                    if (is_file($path)) {
                        $image = new File($path);

                        $image->move(
                            $this->kernel->getProjectDir() . '/public/images/articles/' . $article->getSlug()
                        );
                    } else {
                        throw new Exception("Image: $path not found");
                    }
                }
            }

            $dir = substr($path, 0, strrpos($path, '/'));
            $restFiles = glob("$dir/*");

            foreach ($restFiles as $file) {
                unlink($file);
            }

            rmdir($dir);
        }
    }

    public function postRemove(Article $article): void
    {
        $dir = $this->kernel->getProjectDir()
            . '/public/images/articles/'
            . $article->getSlug();

        $files = glob("$dir/*");

        foreach ($files as $file) {
            if (is_file($file)) {
                unlink($file);
            }
        }

        if (is_dir($dir)) {
            rmdir($dir);
        }
    }
}
