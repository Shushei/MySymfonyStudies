<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace MaciejBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;



class DefaultController extends Controller
{
    function showAction()
    {
        return $this->render('MaciejBundle:Switch:Switch.html.twig');
       
  
        
     
    }
}
