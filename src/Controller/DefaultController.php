<?php

namespace App\Controller;

use App\Entity\Purchase;
use App\Event\PurchaseConfirmedEvent;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
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
}
