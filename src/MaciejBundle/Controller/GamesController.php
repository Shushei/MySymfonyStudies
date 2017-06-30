<?php

namespace MaciejBundle\Controller;

use MaciejBundle\Entity\Games;
use MaciejBundle\Form\GamesType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use MaciejBundle\Service\FileUploader;


class GamesController extends Controller
{

    public function showAction(Request $request )
    {
        $game = new Games();
       

        $form = $this->createForm(GamesType::class, $game);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            
            $em->persist($game);
            $em->flush();
            $games = $em->getRepository('MaciejBundle:Games')->findAll();

            return $this->redirectToRoute('maciej_gameslist', ['games' => $games]);
        }

        return $this->render('MaciejBundle:Games:form.html.twig', array('form' => $form->createView(),));
    }

    public function editAction(Request $request)
    {
        $number = $request->get('wild');
        $em = $this->getDoctrine()->getManager();
        $changed = $em->getRepository('MaciejBundle:Games')->find($number);
        $form = $this->createForm(GamesType::class, $changed);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em->persist($changed);
            $em->flush();

            return $this->redirectToRoute('maciej_gameslist');
        }

        return $this->render('MaciejBundle:Games:edit.html.twig', array('form' => $form->createView(),));
    }

    public function listAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $games = $em->getRepository('MaciejBundle:Games')->findAll();
        $number = $request->get('wild');

        if (!empty($number) && !empty($delete = $em->getRepository('MaciejBundle:Games')->findOneById($number))) {
            $delete = $em->getRepository('MaciejBundle:Games')->find($number);
            $em->remove($delete);
            $em->flush();
            $games = $em->getRepository('MaciejBundle:Games')->findAll();
           
            return $this->render('MaciejBundle:Games:list.html.twig', ['games' => $games]
            );
        }
        
         // Tu próbowałem wczytać tak jak jest w guidach ale nie działa. 
        
        return $this->render('MaciejBundle:Games:list.html.twig', ['games' => $games]);
    }

}
