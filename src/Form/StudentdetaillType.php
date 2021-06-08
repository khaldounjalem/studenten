<?php

namespace App\Form;

use App\Entity\Course;
use App\Entity\Studentdetaill;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class StudentdetaillType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('degree')
            ->add('result')
        //    ->add('numpage')
        //    ->add('numgeneral')

       //    ->add('student')


        ->add('courses', EntityType::class, array(
            'choice_label' => function ( $course) {
                return $course->getNumcourse() . ' | ' .$course->getnamecourse();
            },
           'class' => Course::class,
          // 'choice_value' => 'id',
            'multiple' => true,
            'expanded' => false,
            'query_builder' => function (EntityRepository $er) {
                return $er->createQueryBuilder('c')
                    ->orderBy('c.id', 'desc');
            },
            'by_reference' => false
        ))

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Studentdetaill::class,
        ]);
    }
}
