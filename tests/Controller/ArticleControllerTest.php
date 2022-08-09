<?php

namespace App\Tests\Controller;

use Liip\TestFixturesBundle\Services\DatabaseToolCollection;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class ArticleControllerTest extends WebTestCase
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
            dirname(__DIR__).'/Fixtures/TagTestFixtures.yaml',
            dirname(__DIR__).'/Fixtures/CommentsTestFixtures.yaml',
        ]);
    }

    public function testArticlePage()
    {
        $this->client->request('GET', '/article/liste');
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
    }

    public function testSearchArticlePage()
    {
        $crawler = $this->client->request('GET', '/article/liste');

        $this->assertCount(1, $crawler->filter('.form-filter'));
    }

    public function testNumberArticlePageOne()
    {
        $crawler = $this->client->request('GET', '/article/liste');

        $this->assertCount(6, $crawler->filter('.blog-list .blog-card'));
    }
}
