<?php

namespace App\DataFixtures;

use App\Entity\Categorie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;

class CategorieFixtures extends Fixture
{
    private Generator $faker;

    public function __construct()
    {
        $this->faker = Factory::create('fr_FR');
    }

    public function load(ObjectManager $manager): void
    {
        /*
        for ($i = 0; $i < 10; ++$i) {
            $categorie = new Categorie();

            $categorie->setTitre($this->faker->unique()->word(2))
                ->setActive($this->faker->boolean);

            $manager->persist($categorie);
        }

        $manager->flush();
        */
    }
}
