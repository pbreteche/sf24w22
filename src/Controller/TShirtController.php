<?php

namespace App\Controller;

use App\Entity\TShirt;
use App\Form\TShirtType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/t-shirt')]
class TShirtController extends AbstractController
{
    #[Route('/new', methods: ['GET', 'POST'])]
    public function new(
        Request $request,
        EntityManagerInterface $manager,
    ): Response {
        $tShirt = new TShirt();
        $form = $this->createForm(TShirtType::class, $tShirt);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($tShirt);
            $manager->flush();

            return $this->redirectToRoute('app_tshirt_new');
        }

        return $this->render('t_shirt/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
