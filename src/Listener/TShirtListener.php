<?php

namespace App\Listener;

use App\Entity\TShirt;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsEntityListener;
use Doctrine\ORM\Event\PostPersistEventArgs;
use Doctrine\ORM\Events;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;

#[AsEntityListener(Events::postPersist, entity: TShirt::class)]
readonly class TShirtListener
{
    public function __construct(
        private MailerInterface $mailer,
    ) {
    }

    public function __invoke(TShirt $TShirt, PostPersistEventArgs $eventArgs): void
    {
        $message = (new TemplatedEmail())
            ->from('noreply@example.com')
            ->to('recipient@example.com')
            ->subject('New t-shirt added')
            ->textTemplate('mailer/t_shirt/post_persist.txt.twig')
            ->htmlTemplate('mailer/t_shirt/post_persist.html.twig')
            ->context([
                't_shirt' => $TShirt,
            ])
        ;

        $this->mailer->send($message);
    }
}
