<?php

namespace App\Controller;

use Symfony\Component\Mime\Address;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController
{
    #[Route('test-email')]
    public function test(MailerInterface $mailer)
    {
        $email = (new TemplatedEmail())
            ->from(new Address('admin@my-app-symfony.com', 'My App Symfony'))
            ->to('test@gmail.com')
            ->subject('Votre demande de reinitalisation de mot de passe')
            ->htmlTemplate('security/reset_password/email.html.twig');

        $mailer->send($email);

        dd($mailer, $email);

        return new Response('Ok');
    }
}
