<?php

namespace App\Controller\Language;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\RouterInterface;

/**
 * Locale controller class.
 */
class LocaleController extends AbstractController
{
    /**
     * Constructor of LocaleController class.
     */
    public function __construct(
        private RouterInterface $router
    ) {
    }

    /**
     * Switch the local and save in session app.
     */
    #[Route(
        '/switch/{_locale<%app.supported_locales%>}',
        defaults: ['_locale<%locale%>'],
        name: 'locale.switch'
    )]
    public function switchLocale(Request $request): RedirectResponse
    {
        $locale = $request->getLocale();
        $request->getSession()->set('_locale', $locale);

        $url = $request->headers->get('referer');

        if (!$url) {
            $url = $this->router->generate('home');
        }

        return $this->redirect($url);
    }
}
