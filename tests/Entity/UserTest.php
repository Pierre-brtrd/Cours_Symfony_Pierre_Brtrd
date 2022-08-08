<?php

namespace App\Tests\Entity;

use App\Entity\User;
use App\Repository\UserRepository;
use Liip\TestFixturesBundle\Services\DatabaseToolCollection;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Validator\ConstraintViolation;

class UserTest extends KernelTestCase
{
    protected $databaseTool;

    public function setUp(): void
    {
        parent::setUp();

        $this->databaseTool = self::getContainer()->get(DatabaseToolCollection::class)->get();
    }

    public function testRepositoryCount()
    {
        $users = $this->databaseTool->loadAliceFixture(
            [
                dirname(__DIR__).'/Fixtures/UserTestFixtures.yaml',
            ]
        );

        $users = self::getContainer()->get(UserRepository::class)->count([]);

        $this->assertEquals(12, $users);
    }

    public function getEntity()
    {
        return (new User())
            ->setEmail('test@example.com')
            ->setNom('test')
            ->setPrenom('test')
            ->setAddress('xx rue de test')
            ->setZipCode('75000')
            ->setVille('Paris')
            ->setRoles(['ROLE_EDITOR'])
            ->setPassword('Test1234');
    }

    public function assertHasErrors(User $user, int $number = 0)
    {
        self::bootKernel();
        $errors = self::getContainer()->get('validator')->validate($user);

        $messages = [];

        /** @var ConstraintViolation $error */
        foreach ($errors as $error) {
            $messages[] = $error->getPropertyPath().' -> '.$error->getMessage();
        }

        $this->assertCount($number, $errors, implode(', ', $messages));
    }

    public function testValideUserEntity()
    {
        $this->assertHasErrors($this->getEntity(), 0);
    }

    public function testInvalideEmailUserEntity()
    {
        $user = $this->getEntity()
            ->setEmail('teskjhsdv');

        $this->assertHasErrors($user, 1);
    }

    public function testInvalidePasswordUserEntity()
    {
        $user = $this->getEntity()
            ->setPassword('h');

        $this->assertHasErrors($user, 1);
    }

    public function testInvalideZipCodeUserEntity()
    {
        $user = $this->getEntity()
            ->setZipCode('ksjdhfkjshdf');

        $this->assertHasErrors($user, 1);
    }

    public function testEmailNonUniqueUser()
    {
        $user = $this->getEntity()
            ->setEmail('pierre@test.com');

        $this->assertHasErrors($user, 1);
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        unset($this->databaseTool);
    }
}
