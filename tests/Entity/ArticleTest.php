<?php

namespace App\Tests\Entity;

use App\Entity\Article;
use App\Repository\UserRepository;
use App\Tests\Utils\AssertTestTrait;
use App\Repository\ArticleRepository;
use App\Repository\CategorieRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Liip\TestFixturesBundle\Services\DatabaseToolCollection;

class ArticleTest extends KernelTestCase
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
        $articles = $this->databaseTool->loadAliceFixture(
            [
                \dirname(__DIR__) . '/Fixtures/UserTestFixtures.yaml',
                \dirname(__DIR__) . '/Fixtures/ArticleTestFixtures.yaml',
                \dirname(__DIR__) . '/Fixtures/TagTestFixtures.yaml',
            ]
        );

        $articles = self::getContainer()->get(ArticleRepository::class)->count([]);

        $this->assertSame(20, $articles);
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

    /**
     * @dataProvider provideLengthTitre
     * @return void
     */
    public function testLengthTitle(string $title): void
    {
        $article = $this->getEntity()
            ->setTitre($title);

        $this->assertHasErrors($article, 1);
    }

    private function provideLengthTitre(): array
    {
        return [
            'min' => ['title' => str_repeat('a', 2)],
            'max' => ['title' => str_repeat('a', 151)],
        ];
    }

    /**
     * @dataProvider provideLengthContent
     */
    public function testLentgthContentEntity(string $content): void
    {
        $article = $this->getEntity()
            ->setContent($content);

        $this->assertHasErrors($article, 1);
    }

    private function provideLengthContent(): array
    {
        return [
            'min' => ['content' => str_repeat('a', 2)]
        ];
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        unset($this->databaseTool);
    }
}
