<?php

namespace AndyFranklin\FaqBundle\Form;

use AndyFranklin\FaqBundle\Entity\Answer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AnswerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('body')
            ->add('question');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'csrf_protection' => false,
            'empty_data' => function (FormInterface $form) {
                return new Answer(
                    $form->get('body')->getData(),
                    $form->get('question')->getData()
                );
            },
        ));
    }
}
