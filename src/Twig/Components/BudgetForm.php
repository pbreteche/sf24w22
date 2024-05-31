<?php

namespace App\Twig\Components;

use App\Entity\Budget;
use App\Form\BudgetType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\DefaultActionTrait;
use Symfony\UX\LiveComponent\LiveCollectionTrait;

#[AsLiveComponent]
class BudgetForm extends AbstractController
{
    use DefaultActionTrait;
    use LiveCollectionTrait;

    #[LiveProp(fieldName: 'formData')]
    public ?Budget $budget;

    protected function instantiateForm(): FormInterface
    {
        return $this->createForm(
            BudgetType::class,
            $this->budget,
        );
    }
}