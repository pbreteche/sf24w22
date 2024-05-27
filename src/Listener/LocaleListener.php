<?php

namespace App\Listener;

use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use Symfony\Component\HttpKernel\Event\RequestEvent;

// Translator service define its locale with priority level 16
#[AsEventListener(priority: 96)]
class LocaleListener
{
    public function __invoke(RequestEvent $event): void
    {
        $request = $event->getRequest();

        if ($locale = $request->query->get('locale')) {
            $request->setLocale($locale);
            return;
        }

        $preferredLocale = $request->getPreferredLanguage(['en', 'fr', 'es']);
        if ($preferredLocale) {
            $request->setLocale($preferredLocale);
        }
    }
}
