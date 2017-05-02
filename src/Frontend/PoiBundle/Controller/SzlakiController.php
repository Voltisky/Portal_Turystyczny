<?php

namespace Frontend\PoiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SzlakiController extends Controller {
    public function szlakiAction() {
        $em = $this->getDoctrine()->getManager();
        $items = array();

        try {
            $items = $em->createQuery("SELECT p, pm, m, a FROM BackendPoiBundle:Szlak p "
                            . "LEFT JOIN p.poi_media pm WITH pm.czywiodaca = true "
                            . "LEFT JOIN pm.media m "
                            . "LEFT JOIN p.adres a "
                            . "ORDER BY p.updated_at DESC ")
                    ->setHint(\Doctrine\ORM\Query::HINT_CUSTOM_OUTPUT_WALKER, 'Gedmo\\Translatable\\Query\\TreeWalker\\TranslationWalker')
                    ->getResult();
        } catch (\Exception $ex) {
            
        }

        return $this->render("FrontendPoiBundle:Szlaki:list.html.twig", array(
                    "items" => $items
        ));
    }
}
