<?php
/**
 * Created by PhpStorm.
 * User: Karol Włodek
 * Date: 03.05.2017
 * Time: 21:19
 */

namespace Frontend\PoiBundle\Twig;


use Backend\PoiBundle\Entity\Poi;
use Backend\PoiBundle\Entity\Szlak;

// Frontend/PoiBundle/Twig/PoiExtension.php
class PoiExtension extends \Twig_Extension
{

    //region ...
    private $container;
    private $request;

    public function __construct($container)
    {
        $this->container = $container;
        if ($this->container->isScopeActive('request')) {
            $this->request = $this->container->get('request');
        }
    }

    //endregion

    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('getPath',
                array($this, 'getPath'), array('needs_environment' => true)),
            new \Twig_SimpleFilter('toGps',
                array($this, 'toGps'))
        );
    }

    public function toGps($wgs)
    {
        $st = (int)$wgs;
        $m = (int)(($wgs - $st) * 60);
        $s = round(((($wgs - $st) * 60) - $m) * 60);
        return $st . "° " . $m . "' " . $s . "''";
    }

    //region ...
    // ...
    //endregion

    public function getPath(\Twig_Environment $env, $item)
    {
        $locale = $this->request->getLocale();
        $resultPath = "/";
        if ($item instanceof Szlak) {
            $resultPath = $env->getExtension("routing")->getPath("frontend_szlak_details", array("_locale" => $locale, "slug" => $item->getAlias() ?: "empty", "id" => $item->getId()));
        } elseif ($item instanceof Poi) {
            $resultPath = $env->getExtension("routing")->getPath("frontend_poi_details", array("_locale" => $locale, "slug" => $item->getAlias() ?: "empty", "id" => $item->getId()));
        }

        return $resultPath;
    }
}