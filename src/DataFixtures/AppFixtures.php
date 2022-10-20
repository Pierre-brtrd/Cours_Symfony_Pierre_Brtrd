<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private Generator $faker;

    public function __construct(
        private readonly UserPasswordHasherInterface $hasher
    ) {
        $this->faker = Factory::create('fr_FR');
    }

    public function load(ObjectManager $manager): void
    {
        $roles = ['ROLE_ADMIN', 'ROLE_USER', 'ROLE_EDITOR'];

        $role = ['ROLE_ADMIN'];

        $user = new User();
        $user->setEmail('pierre@test.com')
            ->setPrenom('Pierre')
            ->setNom('Bertrand')
            ->setAddress('Nouvelle Maryland')
            ->setZipCode('72350')
            ->setVille('Chambéry')
            ->setRoles($role);

        $password = $this->hasher->hashPassword($user, 'test1234');
        $user->setPassword($password);

        $manager->persist($user);
        $manager->flush();

        for ($i = 1; $i <= 25; ++$i) {
            $user = new User();

            /** @var array<int, string> $roleUser */
            $roleUser = [$this->faker->randomElement($roles)];

            $user->setEmail($this->faker->unique()->email())
                ->setPrenom($this->faker->firstName())
                ->setNom($this->faker->lastName())
                ->setRoles($roleUser)
                ->setPassword($this->hasher->hashPassword($user, 'test1234'))
                ->setAddress($this->faker->address())
                ->setZipCode('72350')
                ->setVille($this->faker->city());

            $manager->persist($user);
        }

        $manager->flush();
    }
}
