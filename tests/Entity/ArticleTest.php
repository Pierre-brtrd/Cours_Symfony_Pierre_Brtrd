<?php

namespace App\Tests\Entity;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use App\Repository\CategorieRepository;
use App\Repository\UserRepository;
use App\Tests\Utils\AssertTestTrait;
use Liip\TestFixturesBundle\Services\DatabaseToolCollection;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class ArticleTest extends KernelTestCase
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
        $articles = $this->databaseTool->loadAliceFixture(
            [
                dirname(__DIR__).'/Fixtures/UserTestFixtures.yaml',
                dirname(__DIR__).'/Fixtures/ArticleTestFixtures.yaml',
                dirname(__DIR__).'/Fixtures/TagTestFixtures.yaml',
            ]
        );

        $articles = self::getContainer()->get(ArticleRepository::class)->count([]);

        $this->assertEquals(20, $articles);
    }

    public function getEntity()
    {
        $user = self::getContainer()->get(UserRepository::class)->find(1);
        $tag = self::getContainer()->get(CategorieRepository::class)->find(1);

        return (new Article())
            ->setTitre('Article de Test')
            ->setContent('Description de test')
            ->setUser($user)
            ->setActive(true)
            ->addCategory($tag);
    }

    public function testValideArticleEntity()
    {
        $this->assertHasErrors($this->getEntity());
    }

    public function testNonUniqueTitreEntity()
    {
        $article = $this->getEntity()
            ->setTitre('Titre-1');

        $this->assertHasErrors($article, 1);
    }

    public function testMinLentgthContentEntity()
    {
        $article = $this->getEntity()
            ->setContent('Desc');

        $this->assertHasErrors($article, 1);
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        unset($this->databaseTool);
    }
}
