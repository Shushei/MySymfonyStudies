<?php

namespace MaciejBundle\Controller;

use MaciejBundle\Entity\Companies;
use MaciejBundle\Form\CompaniesType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CompaniesController extends Controller
{

    public function formAction(Request $request)
    {
        $company = new Companies();
        $form = $this->createForm(CompaniesType::class, $company);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($company);
            $em->flush();
            $companies = $em->getRepository('MaciejBundle:Companies')->findAll();

            return $this->render('MaciejBundle:Companies:list.html.twig', ['companies' => $companies]);
        }
        return $this->render('MaciejBundle:Companies:form.html.twig', array('form' => $form->createView()));
    }

    public function listAction()
    {
        $em = $this->getDoctrine()->getManager();
        $companies = $em->getRepository('MaciejBundle:Companies')->findAll();

        return $this->render('MaciejBundle:Companies:list.html.twig', ['companies' => $companies]);
    }

    public function deleteAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $number = $request->get('wild');
        $delete = $em->getRepository('MaciejBundle:Companies')->find($number);
        $em->remove($delete);
        $em->flush();

        return $this->redirectToRoute('maciej_companylist');
    }

    public function editAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $number = $request->get('wild');
        $change = $em->getRepository('MaciejBundle:Companies')->find($number);
        $form = $this->createForm(CompaniesType::class, $change);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($change);
            $em->flush();
                    
                    return $this->redirectToRoute('maciej_companylist');
        }
        return $this->render('MaciejBundle:Companies:edit.html.twig', array('form'=>$form->createView()));
    }

}
