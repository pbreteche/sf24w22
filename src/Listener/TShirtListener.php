<?php

namespace App\Listener;

use App\Entity\TShirt;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsEntityListener;
use Doctrine\ORM\Event\PostPersistEventArgs;
use Doctrine\ORM\Events;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\SerializerInterface;

#[AsEntityListener(Events::postPersist, entity: TShirt::class)]
readonly class TShirtListener
{
    public function __construct(
        private MailerInterface $mailer,
        private NormalizerInterface $normalizer,
    ) {
    }

    public function __invoke(TShirt $TShirt, PostPersistEventArgs $eventArgs): void
    {
        /*
         * AS mailer is configured to send mail async with Messenger Component
         * AND Messenger is configured to use DoctrineTransport
         * we cannot serialize binary files
         * THEN, we need to normalize TShirt entity in email context
         */

        $message = (new TemplatedEmail())
            ->from('noreply@example.com')
            ->to('recipient@example.com')
            ->subject('New t-shirt added')
            ->textTemplate('mailer/t_shirt/post_persist.txt.twig')
            ->htmlTemplate('mailer/t_shirt/post_persist.html.twig')
            ->context([
                't_shirt' => $this->normalizer->normalize($TShirt),
            ])
        ;


        $logoFile = $TShirt->getBrand()?->getLogo();
        if ($logoFile) {
            $message->attachFromPath($logoFile->getPathname());
        }

        $this->mailer->send($message);
    }
}
