<?php

namespace App\Form;

use App\Entity\Enum\ClothSize;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EnumType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;

/*
 * Custom types allow usage of specific theme blocks
 * - cloth_size_row
 * - cloth_size_label
 * - ...
 */
class ClothSizeType extends AbstractType
{
    public function getParent(): string
    {
        return EnumType::class;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver
            ->setDefaults([
                'class' => ClothSize::class, // new default value for existing options
                'expanded' => true,
                'all_values' => true, // new option with its default value
            ])
            ->setAllowedTypes('all_values', 'bool')
        ;
    }

    /*
     * Manage FormView, add vars, etc.
     */
    public function buildView(FormView $view, FormInterface $form, array $options): void
    {
        if ($options['all_values']) {
            // send vars to twig blocks
            $view->vars['all_values'] = true;
        }
    }
}
