<?php

namespace App\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FilteredEntityType extends AbstractType
{
    public function getParent(): string
    {
        return EntityType::class;
    }
    public function buildView(FormView $view, FormInterface $form, array $options): void
    {
        if ($options['endpoint_url']) {
            $view->vars['endpoint_url'] = $options['endpoint_url'];
        }
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver
            ->setRequired('endpoint_url')
            ->setAllowedTypes('endpoint_url', 'string')
        ;
    }
}
