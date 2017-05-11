<?php

namespace Frontend\PoiBundle\Controller;

use Ivory\CKEditorBundle\Exception\Exception;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class DefaultController extends Controller
{

    public function getLatestPoiAction($maxItems = 3)
    {
        $em = $this->getDoctrine()->getManager();
        $items = array();
        $konfiguracja = $this->get('app.main.konfiguracja')->getKonfiguracja();

        try {
            $items = $em->createQuery("SELECT p, pm, m, a, u FROM BackendPoiBundle:Poi p "
                . "LEFT JOIN p.poi_media pm WITH pm.czywiodaca = true "
                . "LEFT JOIN pm.media m "
                . "LEFT JOIN p.adres a "
                . "LEFT JOIN p.user u "
                . "ORDER BY p.updated_at DESC ")
                ->setMaxResults($maxItems)
                ->setHint(\Doctrine\ORM\Query::HINT_CUSTOM_OUTPUT_WALKER, 'Gedmo\\Translatable\\Query\\TreeWalker\\TranslationWalker')
                ->getResult();
        } catch (\Exception $ex) {

        }

        return $this->render("FrontendPoiBundle:Poi:latest.html.twig", array(
            "items" => $items
        ));
    }

    public function getLocalInformationsAction()
    {
        $em = $this->getDoctrine()->getManager();
        $mostRead = array();
        $latest = array();
        $maxItems = 2;

        try {
            $mostRead = $em->createQuery("SELECT p, pm, m, a, u FROM BackendPoiBundle:Poi p "
                . "LEFT JOIN p.poi_media pm WITH pm.czywiodaca = true "
                . "LEFT JOIN pm.media m "
                . "LEFT JOIN p.adres a "
                . "LEFT JOIN p.user u "
                . "ORDER BY p.updated_at DESC ")
                ->setHint(\Doctrine\ORM\Query::HINT_CUSTOM_OUTPUT_WALKER, 'Gedmo\\Translatable\\Query\\TreeWalker\\TranslationWalker')
                ->setMaxResults($maxItems)
                ->getResult();

            $latest = $em->createQuery("SELECT p, pm, m, a, u FROM BackendPoiBundle:Poi p "
                . "LEFT JOIN p.poi_media pm WITH pm.czywiodaca = true "
                . "LEFT JOIN pm.media m "
                . "LEFT JOIN p.adres a "
                . "LEFT JOIN p.user u "
                . "ORDER BY p.updated_at DESC ")
                ->setMaxResults(2)
                ->setHint(\Doctrine\ORM\Query::HINT_CUSTOM_OUTPUT_WALKER, 'Gedmo\\Translatable\\Query\\TreeWalker\\TranslationWalker')
                ->getResult();
        } catch (\Exception $ex) {

        }

        return $this->render("FrontendPoiBundle:Poi:local_informations.html.twig", array(
            "mostRead" => $mostRead,
            "latest" => $latest
        ));
    }


    public function nearAction()
    {
        return $this->render("@FrontendPoi/Poi/near.html.twig");
    }

    public function getNearItemsAction()
    {
        $em = $this->getDoctrine()->getManager();
        $request = $this->get('request');
        $items = array();

        $distance = $request->get("distance");
        $x = $request->get("x");
        $y = $request->get("y");

        if ($distance && $x && $y) {
//        try {
            $pow1 = "((p.wgs_y-" . $y . ")*COS(" . $x . "*PI()/180))";
            $pow2 = "(p.wgs_x-" . $x . ")";

            $distanceQuery = "(((SQRT((" . $pow1 . "*" . $pow1 . ")+(" . $pow2 . "*" . $pow2 . "))*PI()*12756.274/360) * 1000))";

            $poiIds = $em->createQuery("SELECT p.id, $distanceQuery as distance FROM BackendPoiBundle:Poi p 
                                        WHERE $distanceQuery < :distance")
                ->setParameter("distance", $distance * 1000)
                ->getResult();

            $items = $em->createQuery("SELECT p, pm, m, a, u FROM BackendPoiBundle:Poi p "
                . "LEFT JOIN p.poi_media pm WITH pm.czywiodaca = true "
                . "LEFT JOIN pm.media m "
                . "LEFT JOIN p.adres a "
                . "LEFT JOIN p.user u "
                . "WHERE p.id IN (:poiIds) "
                . "ORDER BY p.updated_at DESC ")
                ->setParameter("poiIds", $poiIds)
                ->setHint(\Doctrine\ORM\Query::HINT_CUSTOM_OUTPUT_WALKER, 'Gedmo\\Translatable\\Query\\TreeWalker\\TranslationWalker')
                ->getResult();
//        } catch(\Exception $e)
//        {
//
//        }
        }

        $coordinates = array();
        foreach ($items as $item) {
            $coordinates[] = array("x" => $item->getWgsX(), "y" => $item->getWgsY());
        }

        $htmlBody = $this->render("@FrontendPoi/Poi/nearItems.html.twig", array("items" => $items));
        return new Response(json_encode(array("coordinates" => $coordinates, "content" => $htmlBody->getContent())));
    }
}
