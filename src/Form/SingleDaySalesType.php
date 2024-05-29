<?php

namespace App\Form;

use App\Entity\Sales;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SingleDaySalesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('day', DateType::class, [
                'widget' => 'single_text',
                'input' => 'datetime_immutable',
                'getter' => fn (Sales $s): ?\DateTimeImmutable => $s->getBeginAt(),
                'setter' => function (Sales $s, \DateTimeImmutable $d): void
                {
                    $s->setBeginAt($d);
                    $s->setFinishAt($d);
                }
            ])
        ;
    }


    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Sales::class,
        ]);
    }
}