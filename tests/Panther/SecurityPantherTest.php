<?php

namespace App\Test\Panther;

use Liip\TestFixturesBundle\Services\DatabaseToolCollection;
use Symfony\Component\Panther\PantherTestCase;

class SecurityPantherTest extends PantherTestCase
{
    protected $client;

    protected $databaseTool;

    public function setUp(): void
    {
        $this->client = self::createPantherClient();

        $this->databaseTool = self::getContainer()->get(DatabaseToolCollection::class)->get();
        $this->databaseTool->loadAliceFixture([
            dirname(__DIR__).'/Fixtures/UserTestFixtures.yaml',
        ]);
    }

    public function testLoginPage()
    {
        $this->client->request('GET', '/login');

        $this->assertSelectorTextContains('h1', 'Se connecter');
    }

    public function testLoginPageConnection()
    {
        $crawler = $this->client->request('GET', '/login');

        $form = $crawler->selectButton('Se connecter')->form([
            '_username' => 'pierre@test.com',
            '_password' => 'Test1234',
        ]);

        $this->client->submit($form);

        $this->assertPageTitleContains('Page d\'accueil');
    }

    public function testLoginPageBadCredentials()
    {
        $crawler = $this->client->request('GET', '/login');

        $form = $crawler->selectButton('Se connecter')->form([
            '_username' => 'pierre@test.com',
            '_password' => 'kqhfkhjqsf',
        ]);

        $this->client->submit($form);

        $this->assertSelectorTextContains('.alert', 'Identifiants invalides.');
    }
}
