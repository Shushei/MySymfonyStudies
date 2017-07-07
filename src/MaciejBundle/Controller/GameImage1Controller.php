<?php

namespace MaciejBundle\Controller;

use MaciejBundle\Entity\GameImage;
use MaciejBundle\Form\GameImageType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use MaciejBundle\Service\FileUploaderAWS;
use Aws\S3\S3Client;


class GameImage1Controller extends Controller
{

    public function showAction(Request $request)
    {
        $gameimage = new GameImage();


        $form = $this->createForm(GameImageType::class, $gameimage);
        $form->handleRequest($request);
        $em = $this->getDoctrine()->getManager();
        $gamelist = $em->getRepository('MaciejBundle:Games')->findAll();

        if ($form->isSubmitted() && $form->isValid()) {

           
            $file = $gameimage->getGameimage();
            $fileUploader = $this->get(FileUploaderAWS::class);
            $fileUploader->setBucket('gameimage');
            $filename = $fileUploader->upload($file);
            $gameimage->setGameimage($filename);
            $em->persist($gameimage);

            $em->flush();


            return $this->redirectToRoute('maciej_gamesimage1form', array('games' => $gamelist));
        }

        return $this->render('MaciejBundle:GameImage_1:form.html.twig', array('form' => $form->createView(), 'games' => $gamelist));
    }

    public function listAction(Request $request)
    {
            $em = $this->getDoctrine()->getManager();
            $title = $request->get('wild');
           $fileUploader = $this->get(FileUploaderAWS::class);
           $fileUploader->setBucket('gameimage');
           $plainURL = $fileUploader->listing();
           $images = $em->getRepository('MaciejBundle:GameImage')->findAll();
           $games = $em->getRepository('MaciejBundle:Games')->findAll();
           $game1 = $em->getRepository('MaciejBundle:Games')->findOneByTitle($title);
        
        return $this->render('MaciejBundle:GameImage_1:list.html.twig', array(
            'urls' => $plainURL, 
            'games' => $games, 
            'game1'=> $game1,
            'images' => $images));
    }

    public function deleteAction(Request $request)
    {
        
        $key = $request->get('wild');
        $fileUploader = $this->get(FileUploaderAWS::class);
        $fileUploader->delete($key);
        


        return $this->redirectToRoute('maciej_gamesimage1list', array('wild' => 'aaaa'));
    }

}
