<?php

namespace App\Tests\Entity;

use App\Entity\Categorie;
use App\Tests\Utils\AssertTestTrait;
use App\Repository\ArticleRepository;
use App\Repository\CategorieRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Liip\TestFixturesBundle\Services\DatabaseToolCollection;

class CategorieTest extends KernelTestCase
{
    use AssertTestTrait;

    protected $databaseTool;

    protected function setUp(): void
    {
        parent::setUp();

        $this->databaseTool = self::getContainer()->get(DatabaseToolCollection::class)->get();
    }

    public function testRepositoryCount()
    {
        $tags = $this->databaseTool->loadAliceFixture(
            [
                \dirname(__DIR__) . '/Fixtures/ArticleTestFixtures.yaml',
                \dirname(__DIR__) . '/Fixtures/TagTestFixtures.yaml',
            ]
        );

        $tags = self::getContainer()->get(CategorieRepository::class)->count([]);

        $this->assertSame(10, $tags);
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

    /**
     * @dataProvider provideTitleLength
     * @return void
     */
    public function testTitleLength(string $title): void
    {
        $article = $this->getEntity()
            ->setTitre($title);

        $this->assertHasErrors($article, 1);
    }

    /**
     * @return array
     */
    private function provideTitleLength(): array
    {
        return [
            'min' => ['title' => str_repeat('a', 2)],
            'max' => ['title' => str_repeat('a', 101)],
        ];
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        unset($this->databaseTool);
    }
}
