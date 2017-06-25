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

    public function editAction(Request $request)
    {
        $number = $request->get('wild');
        $em = $this->getDoctrine()->getManager();
        $changed = $em->getRepository('MaciejBundle:FormBase')->find($number);
        $form = $this->createForm(FormType::class, $changed);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em->persist($changed);
            $em->flush();

            return $this->redirectToRoute('maciej_list');
        }

        return $this->render('MaciejBundle:Form:edit.html.twig', array('form' => $form->createView(),));
    }
    
    public function listAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $games = $em->getRepository('MaciejBundle:FormBase')->findAll();
        $number = $request->get('wild');

        if (!empty($number) && !empty($delete = $em->getRepository('MaciejBundle:FormBase')->findOneById($number))) {
            $delete = $em->getRepository('MaciejBundle:FormBase')->find($number);
            $em->remove($delete);
            $em->flush();
            $games = $em->getRepository('MaciejBundle:FormBase')->findAll();
            return $this->render('MaciejBundle:Form:list.html.twig', ['games' => $games]);
        }

        return $this->render('MaciejBundle:Form:list.html.twig', ['games' => $games]);
    }

}
