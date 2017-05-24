<?php

namespace Frontend\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{

    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
//        $konfiguracja = $em->createQuery("SELECT k, l, di FROM BackendCommonBundle:Konfiguracja k "
//            . "LEFT JOIN k.logo l "
//            . "LEFT JOIN k.default_image di ")
//            ->setHint(\Doctrine\ORM\Query::HINT_CUSTOM_OUTPUT_WALKER, 'Gedmo\\Translatable\\Query\\TreeWalker\\TranslationWalker')
//            ->getResult();
//        dump($konfiguracja);
//        exit;
        $loggedIn = $this->get("request")->get("loggedIn");
        if ($loggedIn) {
            $this->addFlash("success", $this->get("translator")->trans("frontend.main.user.success"));
        }

        return $this->render('FrontendMainBundle:Main:mainPage.html.twig');
    }

    public function index2Action()
    {
        return $this->render('FrontendMainBundle:Main:mainPage.html.twig');
    }

    public function changeLocaleAction($_locale)
    {
        $request = $this->get('request');
        $session = $request->getSession();
        // Default route
        $lastRoutePath = "frontend_main_homepage_lang";
        $lastRouteParameters = array();
        $lastRoute = array();

//        $lastRoute = $session->get("last_route");
        if (!$lastRoute) {
            $lastRoute = array("name" => $lastRoutePath, "params" => $lastRouteParameters);
        }

        $lastRoute["params"]["_locale"] = $_locale;

        return $this->redirectToRoute($lastRoute["name"], $lastRoute["params"]);
    }

}
