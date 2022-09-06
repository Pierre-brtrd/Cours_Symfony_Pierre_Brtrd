<?php

namespace App\Tests\Entity;

use App\Entity\Categorie;
use App\Repository\ArticleRepository;
use App\Repository\CategorieRepository;
use App\Tests\Utils\AssertTestTrait;
use Liip\TestFixturesBundle\Services\DatabaseToolCollection;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class CategorieTest extends KernelTestCase
{
    use AssertTestTrait;

    protected $databaseTool;

    public function setUp(): void
    {
        parent::setUp();

        $this->databaseTool = self::getContainer()->get(DatabaseToolCollection::class)->get();
    }

    public function testRepositoryCount()
    {
        $tags = $this->databaseTool->loadAliceFixture(
            [
                dirname(__DIR__).'/Fixtures/ArticleTestFixtures.yaml',
                dirname(__DIR__).'/Fixtures/TagTestFixtures.yaml',
            ]
        );

        $tags = self::getContainer()->get(CategorieRepository::class)->count([]);

        $this->assertEquals(10, $tags);
    }

    public function getEntity()
    {
        $article = self::getContainer()->get(ArticleRepository::class)->find(1);

        return (new Categorie())
            ->setTitre('Article de Test')
            ->setActive(true)
            ->addArticle($article);
    }

    public function testValideArticleEntity()
    {
        $this->assertHasErrors($this->getEntity());
    }

    public function testNonUniqueTitreEntity()
    {
        $article = $this->getEntity()
            ->setTitre('Tag 1');

        $this->assertHasErrors($article, 1);
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        unset($this->databaseTool);
    }
}
