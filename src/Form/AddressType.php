<?php

namespace App\Form;

use App\Entity\Address;
use App\Enum\NumberComplement;
use App\Enum\WayType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EnumType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddressType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('number')
            ->add('numberComplement', EnumType::class, [
                'class' => NumberComplement::class,
                'placeholder' => 'form.action.choice'
            ])
            ->add('wayType', EnumType::class, [
                'class' => WayType::class,
                'placeholder' => 'form.action.choice'
            ])
            ->add('wayName')
            ->add('complement')
            ->add('zip')
            ->add('city')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
                                   'data_class' => Address::class,
                               ]);
    }
}
