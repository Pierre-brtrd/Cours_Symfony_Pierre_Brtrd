<?php

namespace App\DataFixtures\Providers;

class CategorieProvider
{
    public function randomTag(): string
    {
        $tagList = [
            'Php Object',
            'NodeJs',
            'Symfony',
            'Twig',
            'Api Platform',
            'JavaScript',
            'GitHub',
            'CI/CD',
            'Framework',
            'WebDesign',
        ];

        return $tagList[array_rand($tagList)];
    }
}
