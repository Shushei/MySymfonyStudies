<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace MaciejBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


/**
 * @Route("/maciej/switch")
 */
class SwitchController extends Controller
{
    function switchAction()
    {
        return $this->render('MaciejBundle:Switch:Switch.html.twig');
       
  
        
     
    }
}
