<?php

namespace MaciejBundle\Controller;

use MaciejBundle\Entity\Games;
use MaciejBundle\Form\GamesType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use MaciejBundle\Service\FileUploader;

class GamesController extends Controller
{

    public function showAction(Request $request)
    {
        $game = new Games();


        $form = $this->createForm(GamesType::class, $game);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $em->persist($game);
            $em->flush();
            

            return $this->redirectToRoute('maciej_gameslist');
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

        return $this->render('MaciejBundle:Games:edit.html.twig', array('form' => $form->createView(), 'changed' => $changed));
    }

    public function listAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $games = $em->getRepository('MaciejBundle:Games')->findAll();
        $number = $request->get('wild');

        if (!empty($number) && !empty($delete = $em->getRepository('MaciejBundle:Games')->findOneById($number))) {
            $delete = $em->getRepository('MaciejBundle:Games')->find($number);
            $fileUploader = $this->get(FileUploader::class);
            if (!empty($fileName = $delete->getLogo())) {
                $fileUploader->delete($fileName);
            }
            foreach ($games as $game) {
                $fileName = $game->getLogo()->getFilename();
                $game->setLogo($fileName);
            }
            $em->remove($delete);
            $em->flush();
           

            return $this->redirectToRoute('maciej_gameslist') ;
           
        }



        return $this->render('MaciejBundle:Games:list.html.twig', ['games' => $games]);
    }

    public function delimgAction(Request $request)
    {
        $fileUploader = $this->get(FileUploader::class);
        $number = $request->get('wild');
        $em = $this->getDoctrine()->getManager();
        $delete = $em->getRepository('MaciejBundle:Games')->find($number);
        $fileName = $delete->getLogo();
        $fileUploader->delete($fileName);


        $delete->setLogo('');
        $em->persist($delete);
        $em->flush();


        return $this->redirectToRoute('maciej_gamesedit', array('wild' => $number));
    }

}
