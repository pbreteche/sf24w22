<?php

namespace App\Controller;

use App\Entity\Sales;
use App\Form\SingleDaySalesType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/sales')]
class SalesController extends AbstractController
{
    #[Route('/new-single', methods: ['GET', 'POST'])]
    public function newSingleDay(
        Request $request,
        EntityManagerInterface $manager,
    ): Response {
        $sales = new Sales();
        $form = $this->createForm(SingleDaySalesType::class, $sales);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($sales);
            $manager->flush();

            return $this->redirectToRoute('app_sales_newsingleday');
        }

        return $this->render('sales/new_single_day.html.twig', [
            'form' => $form,
        ]);
    }
}