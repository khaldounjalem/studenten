<?php

namespace App\Form;

use App\Entity\Course;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CourseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('namecourse')
            ->add('numcourse')
      //      ->add('numdetaillcourse')
            ->add('startdate')
            //->add('day')

            ->add('day', ChoiceType::class,[
                'required' => true,
                'multiple' => false,
                'expanded' => false,
                'choices' => [
                    
                    'Daily' => 'Daily',
                    'Mon Wed Fri' => 'Mon Wed Fri',
                    'Sat Sun Tuesdays' =>'Sat Sun Tuesdays',
                ],
                ])

            ->add('time')
            ->add('teacher')
            ->add('price')
            ->add('enddate')
            ->add('numlessons')
       //     ->add('course')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Course::class,
        ]);
    }
}
