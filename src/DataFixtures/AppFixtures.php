<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    public function __construct(
        private UserPasswordHasherInterface $hasher
    ) {
    }

    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setEmail('pierre@test.com')
            ->setPrenom('Pierre')
            ->setNom('Bertrand')
            ->setAddress('Nouvelle Maryland')
            ->setZipCode(72350)
            ->setVille('Chambéry')
            ->setRoles(['ROLE_ADMIN']);

        $password = $this->hasher->hashPassword($user, 'test1234');
        $user->setPassword($password);

        $manager->persist($user);
        $manager->flush();
    }
}
