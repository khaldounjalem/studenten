<?php

namespace App\Form;

use App\Entity\Payment;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PaymentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('amount')
            ->add('numpayment')
            ->add('notes')
            ->add('type')
         //   ->add('createdAt')
         //   ->add('updatedAt')
            ->add('student')

            ->add('artcours', ChoiceType::class,[
                'required' => true,
                'multiple' => false,
                'expanded' => false,
                'choices' => [
                    
                    'language' => 'language',
                    'Computer' => 'Computer',
                    'Haircut' =>'Haircut',
                    'Sewing' => 'Sewing',
                    'Electron' =>'Electron',                    
                ],
                ])            
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Payment::class,
        ]);
    }
}
