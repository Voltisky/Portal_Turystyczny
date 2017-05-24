<?php

namespace Frontend\MainBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\RequestStack;

class MenuBuilder
{

    private $factory;
    private $container;

    /**
     * @param FactoryInterface $factory
     */
    public function __construct(FactoryInterface $factory, ContainerInterface $container)
    {
        $this->factory = $factory;
        $this->container = $container;
    }

    public function createMainMenu(RequestStack $requestStack)
    {
        $menu = $this->factory->createItem('mainMenu');
        $tr = $this->container->get("translator");

        $menu->addChild($tr->trans("frontend.main.menu.home"), array(
            'route' => 'frontend_main_homepage_lang',
            "attributes" => array("class" => "mdl-navigation__link grey-text text-lighten-3")));
        $menu->addChild($tr->trans("frontend.main.menu.route"), array(
            'route' => 'frontend_poi_szlaki',
            "attributes" => array("class" => "mdl-navigation__link grey-text text-lighten-3")));
        $menu->addChild($tr->trans("frontend.main.menu.explore"), array(
            'route' => 'frontend_category',
            "routeParameters" => array("id" => "12", "slug"=> "atrakcje"),
            "attributes" => array("class" => "mdl-navigation__link grey-text text-lighten-3")));
        $menu->addChild($tr->trans("frontend.main.menu.spend_time"), array(
            'route' => 'frontend_category',
            "routeParameters" => array("id" => "15", "slug"=> "aktywne-miejsca"),
            "attributes" => array("class" => "mdl-navigation__link grey-text text-lighten-3")));
        $menu->addChild($tr->trans("frontend.main.menu.plan"), array(
            'route' => 'frontend_category',
            "routeParameters" => array("id" => "26", "slug"=> "zaplanuj"),
            "attributes" => array("class" => "mdl-navigation__link grey-text text-lighten-3")));
        $menu->addChild($tr->trans("frontend.main.menu.near"), array(
            'route' => 'frontend_poi_near',
            "attributes" => array("class" => "mdl-navigation__link grey-text text-lighten-3")));
        // ... add more children
//	dump($menu);
//	exit;
        return $menu;
    }

}
