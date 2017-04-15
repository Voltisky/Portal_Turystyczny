<?php

namespace Backend\PoiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('BackendPoiBundle:Default:index.html.twig');
    }
}
