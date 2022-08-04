<?php

namespace App\DataFixtures;

use App\Entity\Article;
use App\Repository\CategorieRepository;
use App\Repository\UserRepository;
use DateTimeImmutable;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;

class ZZArticleFixtures extends Fixture
{
    private Generator $faker;

    public function __construct(
        private UserRepository $repoUser,
        private CategorieRepository $repoCategorie
    ) {
        $this->faker = Factory::create('fr_FR');
    }

    public function load(ObjectManager $manager): void
    {
        /*
        $users = $this->repoUser->findAll();
        $categories = $this->repoCategorie->findAll();

        for ($i = 1; $i <= 50; ++$i) {
            $article = new Article();

            $article->setTitre($this->faker->unique()->word(3, true))
                ->setContent($this->faker->sentence(15))
                ->setUser($this->faker->randomElement($users))
                ->addCategory($this->faker->randomElement($categories))
                ->setActive($this->faker->boolean())
                ->setCreatedAt(DateTimeImmutable::createFromMutable($this->faker->dateTimeThisYear()));

            $manager->persist($article);

        }
        $manager->flush();
        */
    }
}
