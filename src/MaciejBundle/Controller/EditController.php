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
        // Zmienna do edycji
        $edit = new FormBase();
        // pobranie zmiennej globalnej
        $global = Request::createFromGlobals();
        $global->getPathInfo();
        $number = $global->get('wild');
        // Doktryna
        $em = $this->getDoctrine()->getManager();
        // Pozycja do zmiany
        $changed = $em->getRepository('MaciejBundle:FormBase')->findOneById($number);
        
        $title = $changed->getTitle();
        $edit->setTitle($title);
        $company = $changed->getCompany();
        $edit->setCompany($company);
        $date = $changed->getReleaseDate();
        $edit->setReleaseDate($date);
        
        $form =$this->createForm(FormType::class, $edit);
       
       $form->handleRequest($request);
        
         if ($form->isSubmitted() && $form->isValid())
        {
          $title =  $edit->getTitle();
          $changed->setTitle($title);
          $company=$edit->getCompany();
          $changed->setCompany($company);
          $date = $edit->getReleaseDate();
          $changed->setReleaseDate($date);
                  
           $em->flush();
          
           return $this->redirectToRoute('maciej_list');
       
        }
       
    return $this->render('MaciejBundle:Form:edit.html.twig', array('form' =>$form->createView(),));
    }   

}

