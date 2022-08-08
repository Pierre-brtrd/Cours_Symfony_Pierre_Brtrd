<?php

namespace App\Tests\Controller;

use App\Repository\UserRepository;
use Liip\TestFixturesBundle\Services\DatabaseToolCollection;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class SecurityControllerTest extends WebTestCase
{
    protected $client;

    protected $databaseTool;

    public function setUp(): void
    {
        $this->client = self::createClient();

        $this->databaseTool = self::getContainer()->get(DatabaseToolCollection::class)->get();
        $this->databaseTool->loadAliceFixture([
            dirname(__DIR__).'/Fixtures/UserTestFixtures.yaml',
            dirname(__DIR__).'/Fixtures/ArticleTestFixtures.yaml',
            dirname(__DIR__).'/Fixtures/CommentsTestFixtures.yaml',
            dirname(__DIR__).'/Fixtures/TagTestFixtures.yaml',
        ]);
    }

    public function testLoginPage()
    {
        $this->client->request('GET', '/login');
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
    }

    public function testAdminNotConnectedLoggedIn()
    {
        $this->client->request('GET', '/admin/article');
        $this->assertResponseStatusCodeSame(Response::HTTP_FOUND);
    }

    public function testAdminUserNotConnectedLoggedIn()
    {
        $this->client->request('GET', '/admin/user');
        $this->assertResponseStatusCodeSame(Response::HTTP_FOUND);
    }

    public function testAdminBadLoggedIn()
    {
        $userRepository = static::getContainer()->get(UserRepository::class);
        $user = $userRepository->find(3);

        $this->client->loginUser($user);

        $this->client->request('GET', '/admin/article');
        $this->assertResponseStatusCodeSame(Response::HTTP_FORBIDDEN);
    }

    public function testAdminGoodLoggedIn()
    {
        $userRepository = static::getContainer()->get(UserRepository::class);
        $userAdmin = $userRepository->findOneByEmail('pierre@test.com');

        $this->client->loginUser($userAdmin);

        $this->client->request('GET', '/admin/article');
        $this->assertResponseIsSuccessful();
    }

    public function testAdminUserGoodLoggedIn()
    {
        $userRepository = static::getContainer()->get(UserRepository::class);
        $userAdmin = $userRepository->findOneByEmail('pierre@test.com');

        $this->client->loginUser($userAdmin);

        $this->client->request('GET', '/admin/user');
        $this->assertResponseIsSuccessful();
    }

    public function testEditorGoodLoggedIn()
    {
        $userRepository = static::getContainer()->get(UserRepository::class);
        $userAdmin = $userRepository->findOneByEmail('editor@test.com');

        $this->client->loginUser($userAdmin);

        $this->client->request('GET', '/admin/article');
        $this->assertResponseIsSuccessful();
    }

    public function testEditorLoggedInUserAdmin()
    {
        $userRepository = static::getContainer()->get(UserRepository::class);
        $userAdmin = $userRepository->findOneByEmail('editor@test.com');

        $this->client->loginUser($userAdmin);

        $this->client->request('GET', '/admin/user');
        $this->assertResponseStatusCodeSame(Response::HTTP_FORBIDDEN);
    }
}
