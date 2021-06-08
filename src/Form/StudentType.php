<?php

namespace App\Form;

use App\Entity\Student;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class StudentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('numstudent')        
            ->add('fullname')
            ->add('father')
            ->add('mother')
            ->add('placeofbirth')
            ->add('dateofbirth')            
            ->add('studying')
            ->add('nationality')
            ->add('telephone')
            ->add('adress')
         //   ->add('status')

           // ->add('createdAt')
           // ->add('updatedAt')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Student::class,
        ]);
    }
}
