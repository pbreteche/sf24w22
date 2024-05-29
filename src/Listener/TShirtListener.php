<?php

namespace App\Listener;

use App\Entity\TShirt;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsEntityListener;
use Doctrine\ORM\Event\PostPersistEventArgs;
use Doctrine\ORM\Events;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

#[AsEntityListener(Events::postPersist, entity: TShirt::class)]
readonly class TShirtListener
{
    public function __construct(
        private MailerInterface $mailer,
    ) {
    }

    public function __invoke(TShirt $TShirt, PostPersistEventArgs $eventArgs): void
    {
        $message = (new Email())
            ->from('noreply@example.com')
            ->to('recipient@example.com')
            ->subject('New t-shirt added')
            ->text('email body as text')
        ;

        $this->mailer->send($message);
    }
}
