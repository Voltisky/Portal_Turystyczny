<?php

namespace Frontend\PoiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class SzlakiController extends Controller
{
    public function szlakiAction()
    {
        $em = $this->getDoctrine()->getManager();
        $items = array();

        try {
            $items = $em->createQuery("SELECT p, pm, m, a, u, e, ep, em FROM BackendPoiBundle:Szlak p "
                . "LEFT JOIN p.poi_media pm WITH pm.czywiodaca = true "
                . "LEFT JOIN pm.media m "
                . "LEFT JOIN p.adres a "
                . "LEFT JOIN p.user u "
                . "LEFT JOIN p.etapy_szlak e "
                . "LEFT JOIN e.poi ep "
                . "LEFT JOIN e.media em "
                . "ORDER BY p.updated_at DESC ")
                ->setHint(\Doctrine\ORM\Query::HINT_CUSTOM_OUTPUT_WALKER, 'Gedmo\\Translatable\\Query\\TreeWalker\\TranslationWalker')
                ->getResult();
        } catch (\Exception $ex) {

        }

        return $this->render("FrontendPoiBundle:Szlaki:list.html.twig", array(
            "items" => $items
        ));
    }

    public function getSzlakItemAction($id, $slug)
    {
        $em = $this->getDoctrine()->getManager();
        $item = null;
        $similarItems = array();
        try {
            $item = $em->createQuery("SELECT p, pm, m, a, u, e, ep, em FROM BackendPoiBundle:Szlak p "
                . "LEFT JOIN p.poi_media pm "
                . "LEFT JOIN pm.media m "
                . "LEFT JOIN p.adres a "
                . "LEFT JOIN p.user u "
                . "LEFT JOIN p.etapy_szlak e "
                . "LEFT JOIN e.poi ep "
                . "LEFT JOIN e.media em "
                . "WHERE p.id = :id AND p.alias = :slug ")
                ->setParameter("id", $id)
                ->setParameter("slug", $slug)
                ->setHint(\Doctrine\ORM\Query::HINT_CUSTOM_OUTPUT_WALKER, 'Gedmo\\Translatable\\Query\\TreeWalker\\TranslationWalker')
                ->getSingleResult();

            $item->setHits($item->getHits() + 1);
            $em->merge($item);
            $em->flush();

            $similarItems = $this->getSimilarItems($slug, $item->getId());
        } catch (\Exception $e) {
//            throw new NotFoundHttpException();
            throw $e;
        }

        return $this->render("@FrontendPoi/Szlaki/szlakDetails.html.twig", array("item" => $item, "similarItems" => $similarItems));
    }

    private function getSimilarItems($similarName, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $items = array();
        try {
            $items = $em->createQuery("SELECT p, pm, m, a, u  FROM BackendPoiBundle:Szlak p "
                . "LEFT JOIN p.poi_media pm WITH pm.czywiodaca = true "
                . "LEFT JOIN pm.media m "
                . "LEFT JOIN p.adres a "
                . "LEFT JOIN p.user u "
                . "WHERE SIMILARITY(p.alias, :similarName) > 0.5  AND p.id != :id ")
                ->setParameter("similarName", $similarName)
                ->setParameter("id", $id)
                ->setMaxResults(3)
                ->setHint(\Doctrine\ORM\Query::HINT_CUSTOM_OUTPUT_WALKER, 'Gedmo\\Translatable\\Query\\TreeWalker\\TranslationWalker')
                ->getResult();
        } catch (\Exception $e) {

        }

        return $items;
    }
}
