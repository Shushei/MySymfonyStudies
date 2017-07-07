<?php

namespace MaciejBundle\Controller;

use MaciejBundle\Entity\GameImage;
use MaciejBundle\Form\GameImageType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use MaciejBundle\Service\FileUploader;
use MaciejBundle\Service\FileuploaderAWS;

class GameImageController extends Controller
{

    public function showAction(Request $request)
    {
        $gameimage = new GameImage();


        $form = $this->createForm(GameImageType::class, $gameimage);
        $form->handleRequest($request);
        $em = $this->getDoctrine()->getManager();
        $gamelist = $em->getRepository('MaciejBundle:Games')->findAll();

        if ($form->isSubmitted() && $form->isValid()) {

            //pilnuje żeby wartość nazwy pliku nie była całą ścieżką
            foreach ($gamelist as $game) {
                $number = $game->getId();
                $company = $em->getRepository('MaciejBundle:Games')->find($number);

                $fileName = $company->getLogo()->getFilename();
                $company->setLogo($fileName);
            }

            $em->persist($gameimage);
            $file = $gameimage->getGameimage();
            $fileUploader = $this->get(FileUploaderAWS::class);
            $fileUploader->setBucket('gameimage');
            $fileUploader->upload($file);
            $em->flush();


            return $this->redirectToRoute('maciej_gamesimageform', array('games' => $gamelist));
        }

        return $this->render('MaciejBundle:GameImage:form.html.twig', array('form' => $form->createView(), 'games' => $gamelist));
    }

    public function listAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $title = $request->get('wild');
        $gamelist = $em->getRepository('MaciejBundle:Games')->findAll();
        $game = $em->getRepository('MaciejBundle:Games')->findOneByTitle($title);
        $images = $em->getRepository('MaciejBundle:GameImage')->findAll();
        return $this->render('MaciejBundle:GameImage:list.html.twig', array(
                    'games' => $gamelist,
                    'game1' => $game,
                    'images' => $images));
    }

    public function deleteAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $fileUploader = $this->get(FileUploader::class);
        $number = $request->get('wild');
        $delete = $em->getRepository('MaciejBundle:GameImage')->Find($number);
        $fileName = $delete->getGameimage();
        $wild = $delete->getTitle()->getTitle();
        $fileUploader->delete($fileName);
        // Temp fix
        
        $fileName1 = $delete->getTitle()->getLogo()->getFilename();
        $delete->getTitle()->setLogo($fileName1);
        
        $em->remove($delete);
        $em->flush();


        return $this->redirectToRoute('maciej_gamesimagelist', array('wild' => $wild));
    }

}
