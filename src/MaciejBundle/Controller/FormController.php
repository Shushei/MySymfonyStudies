<?php

namespace MaciejBundle\Controller;

use MaciejBundle\Entity\FormBase;
use MaciejBundle\Form\FormType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class FormController extends Controller
{

    public function showAction(Request $request)
    {
        $formBase = new FormBase();
       
        $form = $this->createForm(FormType::class, $formBase);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($formBase);
            $em->flush();

            return $this->redirect($this->generateURL('maciej_submit', array('wild' => $formBase->getTitle())));
        }

        return $this->render('MaciejBundle:Form:form.html.twig', array('form' => $form->createView(),));
    }

    public function submitAction()
    {
        return $this->render('MaciejBundle:Submit:Submit.html.twig'
                        /* , array('title' => $title,)
                         */
        );
    }

}

