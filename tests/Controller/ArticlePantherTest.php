<?php

namespace App\Test\Controller;

use Facebook\WebDriver\WebDriverBy;
use Symfony\Component\Panther\PantherTestCase;
use Liip\TestFixturesBundle\Services\DatabaseToolCollection;

class ArticlePantherTest extends PantherTestCase
{
    protected $client;

    protected $databaseTool;

    public function setUp(): void
    {
        $this->client = self::createPantherClient();

        $this->databaseTool = self::getContainer()->get(DatabaseToolCollection::class)->get();
        $this->databaseTool->loadAliceFixture([
            dirname(__DIR__) . '/Fixtures/UserTestFixtures.yaml',
            dirname(__DIR__) . '/Fixtures/ArticleTestFixtures.yaml',
            dirname(__DIR__) . '/Fixtures/CommentsTestFixtures.yaml',
            dirname(__DIR__) . '/Fixtures/TagTestFixtures.yaml',
        ]);
    }

    public function testArticlePage()
    {
        $crawler = $this->client->request('GET', '/article/liste');

        $this->assertCount(6, $crawler->filter('.blog-list .blog-card'));
    }

    public function testArticlePageShowMore()
    {
        $crawler = $this->client->request('GET', '/article/liste');

        $this->client->waitFor('.btn-show-more', 2);

        $this->client->executeScript("document.querySelector('.btn-show-more').click()");

        $this->client->waitForEnabled('.btn-show-more', 2);

        $crawler = $this->client->refreshCrawler();

        $this->assertCount(12, $crawler->filter('.blog-list .blog-card'));
    }

    public function testArticlePageSearchSubmit()
    {
        $crawler = $this->client->request('GET', '/article/liste');

        $this->client->waitFor('.form-filter', 2);

        $form = $crawler->selectButton('Filtrer')->form([
            'query' => 'Titre-2'
        ]);

        $this->client->submit($form);

        $crawler = $this->client->refreshCrawler();

        $this->assertCount(1, $crawler->filter('.blog-list .blog-card'));
    }

    public function testArticlePageSearchAjax()
    {
        $crawler = $this->client->request('GET', '/article/liste');

        $this->client->waitFor('.form-filter');

        $search = $this->client->findElement(WebDriverBy::cssSelector('.form-filter input[type="text"]'));
        $search->sendKeys('Titre-2');

        $this->client->waitFor('.form-response', 2);

        // For the flip content time response
        sleep(1);

        $crawler = $this->client->refreshCrawler();

        $this->assertCount(1, $crawler->filter('.blog-list .blog-card'));
    }
}
