<?php

namespace MaciejBundle\Controller;

use MaciejBundle\Entity\FormBase;
use MaciejBundle\Form\FormType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class FormController extends Controller
{
    public function FormAction(Request $request)
    {
       $formBase = new FormBase();
       $form =$this->createForm(FormType::class, $formBase);
        
            return $this->render('MaciejBundle:Form:form.html.twig', array('form' =>$form->createView(),));
    }
        
}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

