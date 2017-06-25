<?php

namespace MaciejBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use MaciejBundle\Entity\FormBase;
use MaciejBundle\Form\FormType;
use Symfony\Component\HttpFoundation\Request;

class EditController extends Controller
{

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

}
