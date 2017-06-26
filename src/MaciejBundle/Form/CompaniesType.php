<?php

namespace MaciejBundle\Form;

use MaciejBundle\Entity\Companies;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormInterface;

class CompaniesType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('company', TextType::class, array(
                    'required' => true,
                ))
                ->add('founded', DateType::class, array(
                ))
                ->add('ownername', TextType::class, array(
                ))
                ->add('ownersurname', TextType::class, array(
        ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Companies::class,
            'emtpy_data' => function (FormInterface $form) {
                return new Companies($form->get('Company')->getData());
            },
        ));
    }

}
