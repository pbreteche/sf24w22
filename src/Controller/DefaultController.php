<?php

namespace App\Controller;

use App\Entity\Purchase;
use App\Event\PurchaseConfirmedEvent;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Contracts\Cache\ItemInterface;
use Symfony\Contracts\Cache\TagAwareCacheInterface;
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

    #[Route('/cache-demo/{number<\d+>}')]
    public function stats(
        TagAwareCacheInterface $myCachePool,
        int $number,
    ): Response {
        $key = sprintf('app_default_stats_%02d', $number);
        $stats = $myCachePool->get($key, function (ItemInterface $item) {
            $item->expiresAfter(new \DateInterval('PT1H'));
            sleep(1); // Emulate a heavy process
            $item->tag('tag_1');

            return [1, 2, 3];
        });

        // Manually delete one item
        //$myCachePool->deleteItem($key);
        // $myCachePool->invalidateTags(['tag_1']);


        return $this->json($stats);
    }
}
