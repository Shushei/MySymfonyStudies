<?php

namespace MaciejBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('MaciejBundle:Default:index.html.twig');
    }
}
