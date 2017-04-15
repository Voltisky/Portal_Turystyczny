<?php

namespace Backend\AdministracyjneBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('BackendAdministracyjneBundle:Default:index.html.twig');
    }
}
