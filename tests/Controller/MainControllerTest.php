<?php

namespace App\Tests\Controller;

use Liip\TestFixturesBundle\Services\DatabaseToolCollection;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class MainControllerTest extends WebTestCase
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
        ]);
    }

    public function testHomePage()
    {
        $this->client->request('GET', '/');
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
    }

    public function testH1HomePage()
    {
        $this->client->request('GET', '/');
        $this->assertSelectorTextContains('h1', 'Bienvenue sur le blog développé en Symfony');
    }

    public function testArticleHomePage()
    {
        $crawler = $this->client->request('GET', '/');

        $this->assertCount(6, $crawler->filter('.blog-card'));
    }
}
