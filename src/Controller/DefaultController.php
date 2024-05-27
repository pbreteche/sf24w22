<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

class DefaultController extends AbstractController
{
    #[Route('/', methods: 'GET')]
    public function homepage(
        Request $request,
        TranslatorInterface $translator,
    ): Response {
        dump($request->getLocale());
        $request->setLocale('de');
        dump($request->getLocale());
        dump($translator->getLocale());

        return $this->render('default/homepage.html.twig');
    }
}