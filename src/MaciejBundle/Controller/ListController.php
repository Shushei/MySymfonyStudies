<?php

namespace MaciejBundle\Controller;

use MaciejBundle\Entity\FormBase;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Common\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ListController extends Controller 
{
    public function showAction()
    {
        
        $em =$this->getDoctrine()->getManager();
        $games= $em->getRepository('MaciejBundle:FormBase')->findAll();
        
        $request = Request::createFromGlobals();
        $request->getPathInfo();
        $number = $request->get('wild');
        
        if (!empty($number))
        {$delete = $em->getRepository('MaciejBundle:FormBase')->findOneById($number);
        $em->remove($delete);
        $em->flush();
        $games= $em->getRepository('MaciejBundle:FormBase')->findAll();
            return $this->render ('MaciejBundle:List:list.html.twig', ['games' => $games]);
        }
      
       return $this->render ('MaciejBundle:List:list.html.twig', ['games' => $games]);
    }
}

