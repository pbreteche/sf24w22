<?php

namespace App\Controller\API;

use App\Entity\Enum\ClothSize;
use App\Repository\TShirtRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api/t-shirt')]
class TShirtController extends AbstractController
{
    #[Route('/{size}')]
    public function index(
        ClothSize $size,
        TShirtRepository $repository,
    ): Response {
        $tShirts = $repository->findBy(['size' => $size], limit: 50);
        $choices = [];
        foreach ($tShirts as $shirt) {
            $choices[sprintf('%s (%s)', $shirt->getName(), $shirt->getReferenceNumber())] = $shirt->getId();
        }

        return $this->json($choices);
    }
}