<?php

namespace App\Controller;

use App\Entity\Budget;
use App\Entity\Expense;
use App\Entity\TShirt;
use App\Form\BudgetType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/budget')]
class BudgetController extends AbstractController
{
    #[Route('/new', methods: ['GET', 'POST'])]
    public function new(
        Request $request,
        EntityManagerInterface $entityManager,
    ): Response {
        $budget = new Budget();
        $budget->addExpense(new Expense());
        $form = $this->createForm(BudgetType::class, $budget);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($budget);
            $entityManager->flush();

            return $this->redirectToRoute('app_budget_new');
        }

        return $this->render('budget/new.html.twig', [
            'form' => $form,
            'budget' => $budget,
        ]);
    }
}