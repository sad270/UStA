<?php

namespace USTA\AccountBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('USTAAccountBundle:Default:index.html.twig');
    }
}
