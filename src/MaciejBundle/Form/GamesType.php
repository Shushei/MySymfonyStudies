<?php

namespace MaciejBundle\Form;

use MaciejBundle\Entity\Games;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\Extension\Core\Type\FileType;


class GamesType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('Company', EntityType::class, array(
                    'class' => 'MaciejBundle:Companies',
                    'choice_label' => 'company',
                    ))
                ->add('Title', TextType::class, array(
                ))
                ->add('releaseDate', DateType::class)
                ->add('logo', FileType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Games::class,
            'emtpy_data' => function (FormInterface $form) {
                return new Games($form->get('Company')->getData());
            },
        ));
    }

}
