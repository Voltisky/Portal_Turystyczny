<?php

namespace Frontend\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller {

    public function indexAction() {
	return $this->render('FrontendMainBundle:Main:mainPage.html.twig');
    }

    public function index2Action() {
	return $this->render('FrontendMainBundle:Main:mainPage.html.twig');
    }

}
