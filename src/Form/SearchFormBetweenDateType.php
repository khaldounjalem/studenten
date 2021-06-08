<?php

namespace App\Form;

use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchFormBetweenDateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('from', DateType::class, [
            'label' => false,
            'attr' => [
                'placeholder' => 'From',
            ],
            'required' => false,
            'data' => new \DateTime ('2021-01-01 00:00:00')
        ])
        ->add('to', DateType::class, [
            'label' => false,
            'attr' => [
                'placeholder' => 'To'
            ],
            'required' => false,
            'data' => new \DateTime()
        ])

        ->add('mots', TextType::class, [
            'label' => false,
            'attr' => [
                'placeholder' => 'Full Name'
            ],
            'required' => false,
        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
