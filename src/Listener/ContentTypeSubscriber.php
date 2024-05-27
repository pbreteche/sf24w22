<?php

namespace App\Listener;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\RequestEvent;

class ContentTypeSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents(): array
    {
        return [
           RequestEvent::class => 'onRequest',
        ];
    }

    public function onRequest(RequestEvent $event): void
    {
        $request = $event->getRequest();
        $format = $request->getPreferredFormat();

        if (in_array($format, ['html', 'json'])) {
            $request->setRequestFormat($format);
        }
    }
}
