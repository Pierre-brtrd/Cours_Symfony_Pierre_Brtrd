<?php

namespace App\DataFixtures\Providers;

use DateTimeImmutable;
use Faker\Factory;
use Faker\Generator;

class ArticleProvider
{
    private Generator $faker;

    public function __construct()
    {
        $this->faker = Factory::create('fr_FR');
    }

    public function generateLoremDesc(): string
    {
        $content = file_get_contents('https://loripsum.net/api/10/long/headers/link/ul/dl');

        return $content;
    }

    public function generateDate(): DateTimeImmutable
    {
        $datetime = DateTimeImmutable::createFromMutable($this->faker->dateTimeThisYear());

        return $datetime;
    }
}
