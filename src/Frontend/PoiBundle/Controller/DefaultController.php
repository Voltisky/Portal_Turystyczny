<?php

namespace Frontend\PoiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller {

    public function getLatestPoiAction($maxItems = 3) {
        $em = $this->getDoctrine()->getManager();
        $items = array();
        $konfiguracja = $this->get('app.main.konfiguracja')->getKonfiguracja();
        
        try {
            $items = $em->createQuery("SELECT p, pm, m, a FROM BackendPoiBundle:Poi p "
                            . "LEFT JOIN p.poi_media pm WITH pm.czywiodaca = true "
                            . "LEFT JOIN pm.media m "
                            . "LEFT JOIN p.adres a "
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

    public function getLocalInformationsAction() {
        $em = $this->getDoctrine()->getManager();
        $mostRead = array();
        $latest = array();
        $maxItems = 2;
        
        try {
            $mostRead = $em->createQuery("SELECT p, pm, m, a FROM BackendPoiBundle:Poi p "
                            . "LEFT JOIN p.poi_media pm WITH pm.czywiodaca = true "
                            . "LEFT JOIN pm.media m "
                            . "LEFT JOIN p.adres a "
                            . "ORDER BY p.updated_at DESC ")
                    ->setHint(\Doctrine\ORM\Query::HINT_CUSTOM_OUTPUT_WALKER, 'Gedmo\\Translatable\\Query\\TreeWalker\\TranslationWalker')
                    ->setMaxResults($maxItems)
                    ->getResult();

            $latest = $em->createQuery("SELECT p, pm, m, a FROM BackendPoiBundle:Poi p "
                            . "LEFT JOIN p.poi_media pm WITH pm.czywiodaca = true "
                            . "LEFT JOIN pm.media m "
                            . "LEFT JOIN p.adres a "
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

}
