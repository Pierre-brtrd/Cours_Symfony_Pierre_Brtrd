<?php

namespace App\EventListener;

use App\Entity\Article;
use Doctrine\ORM\Events;
use Symfony\Component\HttpKernel\KernelInterface;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsEntityListener;

#[AsEntityListener(event: Events::postRemove, method: 'postRemove', entity: Article::class)]
class ArticleImageListener
{
    public function __construct(
        private KernelInterface $kernel
    ) {
    }

    public function postRemove(Article $article): void
    {
        $dir = $this->kernel->getProjectDir()
            . '/public/images/articles/'
            . $article->getSlug();

        $files = glob("$dir/*");

        foreach ($files as $file) {
            if (is_file($file)) unlink($file);
        }

        if (is_dir($dir)) {
            rmdir($dir);
        }
    }
}
