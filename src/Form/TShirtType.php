<?php

namespace App\Form;

use App\Entity\TShirt;
use App\Form\EventListener\UCFirstSubscriber;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Event\PreSetDataEvent;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TShirtType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('referenceNumber')
            ->add('name')
            ->add('price', MoneyType::class, [
                'divisor' => 100,
            ])
            ->add('description')
            ->add('size', ClothSizeType::class, [
                'placeholder' => 'cloth_size.select',
            ])
            ->add('brand', BrandType::class, [
                'label' => false,
                'required' => false,
            ])
            ->addEventListener(FormEvents::PRE_SET_DATA, $this->disableRefNum(...))
            //->addEventListener(FormEvents::PRE_SET_DATA, [$this, 'disableRefNum'])
            ->add('tags', TextareaType::class)
        ;
        $builder->get('tags')
            ->addModelTransformer(new CallbackTransformer(
                fn (array $v): string => implode("\r\n", $v),
                fn (string $v): array => explode("\r\n", $v),
            ))
        ;

        $builder->get('name')
            ->addEventSubscriber(new UCFirstSubscriber())
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => TShirt::class,
            'label_format' => 't_shirt.%name%.label',
        ]);
    }

    private function disableRefNum(PreSetDataEvent $event): void
    {
        /** @var TShirt $data */
        $data = $event->getData();
        $form = $event->getForm();

        if ($data->getReferenceNumber()) {
            $form->add('referenceNumber', options: ['disabled' => true]);
        }
    }
}
