<?php

namespace Frontend\MainBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\HttpFoundation\RequestStack;

class MenuBuilder
{

    private $factory;

    /**
     * @param FactoryInterface $factory
     */
    public function __construct(FactoryInterface $factory)
    {
        $this->factory = $factory;
    }

    public function createMainMenu(RequestStack $requestStack)
    {
        $menu = $this->factory->createItem('mainMenu');

        $menu->addChild('Home', array(
            'route' => 'frontend_main_homepage',
            "attributes" => array("class" => "mdl-navigation__link")));
        $menu->addChild('Szlaki', array(
            'route' => 'frontend_poi_szlaki',
            "attributes" => array("class" => "mdl-navigation__link")));
        $menu->addChild('Poznawaj', array(
            'route' => 'frontend_category',
            "routeParameters" => array("id" => "1", "slug"=> "root"),
            "attributes" => array("class" => "mdl-navigation__link")));
        $menu->addChild('Spędzaj czas', array(
            'route' => 'frontend_category',
            "routeParameters" => array("id" => "1", "slug"=> "root"),
            "attributes" => array("class" => "mdl-navigation__link")));
        $menu->addChild('Zaplanuj pobyt', array(
            'route' => 'frontend_category',
            "routeParameters" => array("id" => "1", "slug"=> "root"),
            "attributes" => array("class" => "mdl-navigation__link")));
        $menu->addChild('W pobliżu', array(
            'route' => 'frontend_poi_near',
            "attributes" => array("class" => "mdl-navigation__link")));
        // ... add more children
//	dump($menu);
//	exit;
        return $menu;
    }

}
