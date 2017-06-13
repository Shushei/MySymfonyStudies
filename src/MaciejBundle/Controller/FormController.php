<?php

namespace MaciejBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class FormController extends Controller
{
    public function FormAction()
    {
            return $this->render('MaciejBundle:Form:form.html.twig');
    }
        
}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

