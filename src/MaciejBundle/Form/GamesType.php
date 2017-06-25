<?php

namespace MaciejBundle\Form;

use MaciejBundle\Entity\FormBase;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormInterface;

class FormType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('Company', TextType::class, array(
                    'required' => true,
                ))
                ->add('Title', TextType::class, array(
                ))
                ->add('releaseDate', DateType::class, array('widget' => 'single_text'));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => FormBase::class,
            'emtpy_data' => function (FormInterface $form) {
                return new FormBase($form->get('Company')->getData());
            },
        ));
    }

}
