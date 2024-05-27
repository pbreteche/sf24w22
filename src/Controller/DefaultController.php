<?php

namespace App\Controller;

use App\Entity\Purchase;
use App\Event\PurchaseConfirmedEvent;
use Psr\Cache\CacheItemInterface;
use Psr\Cache\CacheItemPoolInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\Cache;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;

class DefaultController extends AbstractController
{
    #[Route('/', methods: 'GET')]
    public function homepage(
        EventDispatcherInterface $eventDispatcher,
    ): Response {
        $purchase = new Purchase();
        $purchase->setPriority(true);
        $eventDispatcher->dispatch(new PurchaseConfirmedEvent($purchase));

        return $this->render('default/homepage.html.twig');
    }

    #[Route('/cache-demo')]
    public function stats(
        CacheItemPoolInterface $pool,
    ): Response {
        $stats = $pool->get('app_default_stats', function (CacheItemInterface $item) {
            $item->expiresAfter(new \DateInterval('PT1H'));
            sleep(10); // Emulate a heavy process

            return [1, 2, 3];
        });

        return $this->json($stats);
    }
}
