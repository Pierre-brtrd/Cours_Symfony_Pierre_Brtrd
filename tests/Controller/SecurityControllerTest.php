<?php

namespace App\Tests\Controller;

use App\Repository\UserRepository;
use Exception;
use Liip\TestFixturesBundle\Services\DatabaseToolCollection;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class SecurityControllerTest extends WebTestCase
{
    protected $client;

    protected $databaseTool;

    protected $userRepository;

    public function setUp(): void
    {
        $this->client = self::createClient();

        $this->userRepository = static::getContainer()->get(UserRepository::class);

        $this->databaseTool = self::getContainer()->get(DatabaseToolCollection::class)->get();
        $this->databaseTool->loadAliceFixture([
            dirname(__DIR__).'/Fixtures/UserTestFixtures.yaml',
        ]);
    }

    public function testLoginPage()
    {
        $this->client->request('GET', '/login');
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
    }

    public function testLoginPageContentHeadingPage()
    {
        $this->client->request('GET', '/login');
        $this->assertSelectorTextContains('h1', 'Se connecter');
    }

    public function testAdminNotConnectedLoggedIn()
    {
        $this->client->request('GET', '/admin/article');
        $this->assertResponseStatusCodeSame(Response::HTTP_FOUND);
    }

    public function testAdminUserNotConnectedLoggedIn()
    {
        $this->client->request('GET', '/admin/user');
        $this->assertResponseStatusCodeSame(Response::HTTP_FOUND);
    }

    public function testAdminBadLoggedIn()
    {
        $user = $this->userRepository->find(3);

        $this->client->loginUser($user);

        $this->client->request('GET', '/admin/article');
        $this->assertResponseStatusCodeSame(Response::HTTP_FORBIDDEN);
    }

    public function testAdminGoodLoggedIn()
    {
        $userAdmin = $this->userRepository->findOneByEmail('pierre@test.com');

        $this->client->loginUser($userAdmin);

        $this->client->request('GET', '/admin/article');
        $this->assertResponseIsSuccessful();
    }

    public function testAdminUserGoodLoggedIn()
    {
        $userAdmin = $this->userRepository->findOneByEmail('pierre@test.com');

        $this->client->loginUser($userAdmin);

        $this->client->request('GET', '/admin/user');
        $this->assertResponseIsSuccessful();
    }

    public function testEditorGoodLoggedIn()
    {
        $userAdmin = $this->userRepository->findOneByEmail('editor@test.com');

        $this->client->loginUser($userAdmin);

        $this->client->request('GET', '/admin/article');
        $this->assertResponseIsSuccessful();
    }

    public function testEditorLoggedInUserAdmin()
    {
        $userAdmin = $this->userRepository->findOneByEmail('editor@test.com');

        $this->client->loginUser($userAdmin);

        $this->client->request('GET', '/admin/user');
        $this->assertResponseStatusCodeSame(Response::HTTP_FORBIDDEN);
    }

    public function testRegisterPage()
    {
        $this->client->request('GET', '/register');
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
    }

    public function testRegisterPageContentHeadingPage()
    {
        $this->client->request('GET', '/register');
        $this->assertSelectorTextContains('h1', 'S\'inscrire');
    }

    public function testRegisterNewUser()
    {
        $crawler = $this->client->request('GET', '/register');
        $form = $crawler->selectButton('S\'incrire')->form([
            'registration_form[prenom]' => 'John',
            'registration_form[nom]' => 'Doe',
            'registration_form[email]' => 'john@example.com',
            'registration_form[password][first]' => 'Test1234',
            'registration_form[password][second]' => 'Test1234',
            'registration_form[address]' => 'XX rue de test',
            'registration_form[zipCode]' => '75000',
            'registration_form[ville]' => 'Paris',
        ]);

        $this->client->submit($form);

        $newUser = $this->userRepository->findOneByEmail('john@example.com');

        if (!$newUser) {
            throw new Exception('User not created');
        }

        $this->assertResponseRedirects();
    }

    public function testRegisterNewUserWithInvalidEmail()
    {
        $crawler = $this->client->request('GET', '/register');
        $form = $crawler->selectButton('S\'incrire')->form([
            'registration_form[prenom]' => 'John',
            'registration_form[nom]' => 'Doe',
            'registration_form[email]' => 'john@com',
            'registration_form[password][first]' => 'Test1234',
            'registration_form[password][second]' => 'Test1234',
            'registration_form[address]' => 'XX rue de test',
            'registration_form[zipCode]' => '75000',
            'registration_form[ville]' => 'Paris',
        ]);

        $this->client->submit($form);
        $this->assertSelectorTextContains('.invalid-feedback', 'Veuillez rentrer un email valide.');
    }

    public function testRegisterNewUserWithInvalidZipCode()
    {
        $crawler = $this->client->request('GET', '/register');
        $form = $crawler->selectButton('S\'incrire')->form([
            'registration_form[prenom]' => 'John',
            'registration_form[nom]' => 'Doe',
            'registration_form[email]' => 'john@example.com',
            'registration_form[password][first]' => 'Test1234',
            'registration_form[password][second]' => 'Test1234',
            'registration_form[address]' => 'XX rue de test',
            'registration_form[zipCode]' => 'ldjfsldkjf',
            'registration_form[ville]' => 'Paris',
        ]);

        $this->client->submit($form);
        $this->assertSelectorTextContains('.invalid-feedback', 'Veuillez rentrer un code postal valide.');
    }

    public function testRegisterNewUserWithInvalidPassword()
    {
        $crawler = $this->client->request('GET', '/register');
        $form = $crawler->selectButton('S\'incrire')->form([
            'registration_form[prenom]' => 'John',
            'registration_form[nom]' => 'Doe',
            'registration_form[email]' => 'john@example.com',
            'registration_form[password][first]' => 'test',
            'registration_form[password][second]' => 'test',
            'registration_form[address]' => 'XX rue de test',
            'registration_form[zipCode]' => '75000',
            'registration_form[ville]' => 'Paris',
        ]);

        $this->client->submit($form);
        $this->assertSelectorTextContains('.invalid-feedback', 'Votre mot de passe doit faire plus de 6 caractères');
    }

    public function testRegisterNewUserWithInvalidSecondPassword()
    {
        $crawler = $this->client->request('GET', '/register');
        $form = $crawler->selectButton('S\'incrire')->form([
            'registration_form[prenom]' => 'John',
            'registration_form[nom]' => 'Doe',
            'registration_form[email]' => 'john@example.com',
            'registration_form[password][first]' => 'Test1234',
            'registration_form[password][second]' => 'test',
            'registration_form[address]' => 'XX rue de test',
            'registration_form[zipCode]' => '75000',
            'registration_form[ville]' => 'Paris',
        ]);

        $this->client->submit($form);
        $this->assertSelectorTextContains('.invalid-feedback', 'Les mot de passe ne correspondent pas.');
    }
}
