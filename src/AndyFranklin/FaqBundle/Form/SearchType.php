<?php

namespace AndyFranklin\FaqBundle\Form;

use AndyFranklin\FaqBundle\Entity\Search;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'csrf_protection' => false,
            'empty_data' => function (FormInterface $form) {
                return new Search(
                    $form->get('title')->getData()
                );
            },
        ));
    }
}
