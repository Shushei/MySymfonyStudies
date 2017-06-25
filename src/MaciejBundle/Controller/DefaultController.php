<?php



namespace MaciejBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;



class DefaultController extends Controller
{
    function showAction()
    {
        return $this->render('MaciejBundle:Default:Default.html.twig');
       
  
        
     
    }
}
