<?php

namespace App\Form\EventListener;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\Event\SubmitEvent;
use Symfony\Component\Form\FormEvents;

class UCFirstSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents(): array
    {
        return [
            FormEvents::SUBMIT => ['onSubmit', 100],
        ];
    }

    public function onSubmit(SubmitEvent $event): void
    {
        $data = $event->getData();
        if (!is_string($data)) {
            return;
        }

        $event->setData(ucfirst($data));
    }
}
