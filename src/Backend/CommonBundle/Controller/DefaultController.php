<?php

namespace Backend\CommonBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('BackendCommonBundle:Default:index.html.twig');
    }
}
