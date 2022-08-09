<?php

namespace App\Tests\Entity;

use App\Entity\Comments;
use App\Repository\ArticleRepository;
use App\Repository\CommentsRepository;
use App\Repository\UserRepository;
use Liip\TestFixturesBundle\Services\DatabaseToolCollection;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Validator\ConstraintViolation;

class CommentsTest extends KernelTestCase
{
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
                dirname(__DIR__).'/Fixtures/CommentsTestFixtures.yaml',
            ]
        );

        $tags = self::getContainer()->get(CommentsRepository::class)->count([]);

        $this->assertEquals(10, $tags);
    }

    public function getEntity()
    {
        $article = self::getContainer()->get(ArticleRepository::class)->find(1);
        $user = self::getContainer()->get(UserRepository::class)->find(1);

        return (new Comments())
            ->setTitre('Commentaire de test')
            ->setContent('Description')
            ->setActive(true)
            ->setRgpd(true)
            ->setNote(5)
            ->setUser($user)
            ->setArticle($article);
    }

    public function assertHasErrors(Comments $article, int $number = 0)
    {
        self::bootKernel();
        $errors = self::getContainer()->get('validator')->validate($article);

        $messages = [];

        /** @var ConstraintViolation $error */
        foreach ($errors as $error) {
            $messages[] = $error->getPropertyPath().' -> '.$error->getMessage();
        }

        $this->assertCount($number, $errors, implode(', ', $messages));
    }

    public function testValideCommentEntity()
    {
        $this->assertHasErrors($this->getEntity());
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        unset($this->databaseTool);
    }
}
