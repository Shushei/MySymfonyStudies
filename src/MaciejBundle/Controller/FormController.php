<?php

namespace MaciejBundle\Controller;

use MaciejBundle\Entity\FormBase;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class FormController extends Controller
{
    public function FormAction(Request $request)
    {
        $company = new FormBase();
        $company->setCompany('Blizzard');
        $company->setTitle('World of Warcraft');
        $company->setReleaseDate(new \DateTime('yesterday'));
        
        $form = $this->createFormBuilder($company)
                ->add('Company', TextType::class)
                ->add('Title', TextType::class)
                ->add('releaseDate', DateType::class)
                ->add('save', SubmitType::class, array('label' => 'Create Post'))
                ->getForm();
              
        
            return $this->render('MaciejBundle:Form:form.html.twig', array('form' =>$form->createView(),));
    }
        
}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

