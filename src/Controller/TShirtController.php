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
        // Create form and set data inside
        // dispatch PRE_SET_DATA and POST_SET_DATA
        $form = $this->createForm(TShirtType::class, $tShirt);
        // Map request data to form model
        // dispatch PRE_SUBMIT, SUBMIT and POST_SUBMIT
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($tShirt);
            if ($tShirt->getBrand()) {
                $manager->persist($tShirt->getBrand());
            }
            $manager->flush();



            return $this->redirectToRoute('app_tshirt_new');
        }

        return $this->render('t_shirt/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    #[Route('/edit/{id}', methods: ['GET', 'POST'])]
    public function edit(
        Request $request,
        TShirt $tShirt,
        EntityManagerInterface $manager,
    ): Response {
        $form = $this->createForm(TShirtType::class, $tShirt);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->flush();

            return $this->redirectToRoute('app_tshirt_new');
        }

        return $this->render('t_shirt/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
