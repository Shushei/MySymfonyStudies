<?php

namespace MaciejBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class FirstController extends Controller
{
    
    
    public function showAction()
    {
        
         $title='Pierwsza'; 
      
        return $this->render('MaciejBundle:First:First.html.twig', array('title' =>$title));
    }
}

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

