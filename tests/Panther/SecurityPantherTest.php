<?php

namespace App\Test\Panther;

use Liip\TestFixturesBundle\Services\DatabaseToolCollection;
use Symfony\Component\Panther\PantherTestCase;

class SecurityPantherTest extends PantherTestCase
{
    protected $client;

    protected $databaseTool;

    protected function setUp(): void
    {
        $this->client = static::createPantherClient(['browser' => static::FIREFOX]);

        $this->databaseTool = self::getContainer()->get(DatabaseToolCollection::class)->get();
        $this->databaseTool->loadAliceFixture([
            \dirname(__DIR__).'/Fixtures/UserTestFixtures.yaml',
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

    public function testLoginPageUserNotVerified()
    {
        $crawler = $this->client->request('GET', '/login');

        $form = $crawler->selectButton('Se connecter')->form([
            '_username' => 'editor@test.com',
            '_password' => 'kqhfkhjqsf',
        ]);

        $this->client->submit($form);

        $this->assertSelectorTextContains('.alert', 'Votre adresse email n\'est pas vérifiée, veuillez cliquer sur le lien envoyé par email lors de votre inscription');
    }
}
