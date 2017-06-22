<?php

namespace MaciejBundle\Controller;

use MaciejBundle\Entity\FormBase;
use MaciejBundle\Form\FormType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;



class FormController extends Controller
{
    public function showAction(Request $request)
    {
       $formBase = new FormBase();
       $formBase->setCompany('Company Name');
       $formBase->setTitle('Game Title');
       $formBase->setReleaseDate(new \DateTime('yesterday'));
               
               
       $form =$this->createForm(FormType::class, $formBase);
       
       $form->handleRequest($request);
       
       if ($form->isSubmitted() && $form->isValid())
       {
           $em = $this->getDoctrine()->getManager();
          $em->persist($formBase);
           $em->flush();
           
           $title= $formBase->getTitle();
                   
           return $this->redirect($this->generateURL('maciej_submit', array('wild' => $formBase->getTitle())));
           
       }
      
        
            return $this->render('MaciejBundle:Form:form.html.twig', array('form' =>$form->createView(),));
   
        }
        public function submitAction()
        {
         
            
          
            
            return $this->render('MaciejBundle:Submit:Submit.html.twig'
                    /*, array('title' => $title,)
             */
              );
             
             
        }
        
}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

