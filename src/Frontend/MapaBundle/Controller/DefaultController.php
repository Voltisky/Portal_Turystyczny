<?php

namespace Frontend\MapaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller {

    public function indexAction() {
	return $this->render('FrontendMapaBundle:Default:index.html.twig');
    }

    public function getFrontendMapaAction($maxItems = 100) {
	$em = $this->getDoctrine()->getManager();
	$items = array();

	try
	{
	    $items = $em->createQuery("SELECT p.id, p.wgs_x, p.wgs_y FROM BackendPoiBundle:Poi p "
			    . "WHERE p.status_poi = 'opublikowany' "
			    . "AND p.wgs_x is not null "
			    . "AND p.wgs_y is not null ")
		    ->setMaxResults($maxItems)
		    ->getResult();
	}
	catch (\Exception $ex)
	{

	}


	return $this->render('FrontendMapaBundle:Map:frontend_map.html.twig', array(
		    "items" => json_encode($items)
	));
    }

}
