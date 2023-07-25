<?php

namespace App\Controller\Security;

use App\Entity\User;
use App\Security\EmailVerifier;
use App\Form\RegistrationFormType;
use App\Repository\UserRepository;
use Symfony\Component\Mime\Address;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use SymfonyCasts\Bundle\VerifyEmail\Exception\VerifyEmailExceptionInterface;

class RegistrationController extends AbstractController
{
    private EmailVerifier $emailVerifier;

    public function __construct(EmailVerifier $emailVerifier)
    {
        $this->emailVerifier = $emailVerifier;
    }

    #[Route('/register', name: 'register')]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            $entityManager->persist($user);
            $entityManager->flush();

            // generate a signed url and email it to the user
            $this->emailVerifier->sendEmailConfirmation(
                'app.verify.email',
                $user,
                (new TemplatedEmail())
                    ->from(new Address('no-reply@my-app-symfony.com', 'My App Symfony'))
                    ->to($user->getEmail())
                    ->subject('Confirmez votre adresse email')
                    ->htmlTemplate('Security/Registration/confirmation_email.html.twig')
            );
            // do anything else you need here, like send an email
            $this->addFlash('success', 'Vous êtes bien inscrit à notre application, vous devez confirmer votre adresse email avant de vous connecter en cliquant que le lien envoyé par email');

            return $this->redirectToRoute('login');
        }

        return $this->render('Security/Registration/register.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/verify/email', name: 'app.verify.email')]
    public function verifyUserEmail(Request $request, TranslatorInterface $translator, UserRepository $userRepository): Response
    {
        $id = $request->query->get('id');

        if (null === $id) {
            return $this->redirectToRoute('register');
        }

        $user = $userRepository->find($id);

        if (null === $user) {
            return $this->redirectToRoute('register');
        }

        // validate email confirmation link, sets User::isVerified=true and persists
        try {
            $this->emailVerifier->handleEmailConfirmation($request, $user);
        } catch (VerifyEmailExceptionInterface $exception) {
            $this->addFlash('verify_email_error', $translator->trans($exception->getReason(), [], 'VerifyEmailBundle'));

            return $this->redirectToRoute('register');
        }

        // @TODO Change the redirect on success and handle or remove the flash message in your templates
        $this->addFlash('success', 'Votre adresse email a été vérifiée.');

        return $this->redirectToRoute('login');
    }
}
