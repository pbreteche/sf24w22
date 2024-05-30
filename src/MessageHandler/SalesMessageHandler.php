<?php

namespace App\MessageHandler;

use App\Message\SalesMessage;
use Psr\Log\LoggerInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
readonly class SalesMessageHandler
{
    public function __construct(
        private LoggerInterface $logger,
    ) {
    }

    public function __invoke(SalesMessage $message): void
    {
        $this->logger->debug('Prise en charge du message pour la promo du '.$message->getSales()->getBeginAt()->format('c'));
    }
}
