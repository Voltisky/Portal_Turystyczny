<?php

namespace Frontend\MainBundle\EventListener;

use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\HttpKernel\HttpKernel;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;

class MainEventListener implements EventSubscriberInterface {

    private $defaultLocale;

    public function __construct(ContainerInterface $container) // this is @service_container
    {
        $this->container = $container;
    }

    public function onKernelRequest(GetResponseEvent $event) {
        $translatable = $this->container->get('gedmo.listener.translatable');
        $translatable->setTranslatableLocale($event->getRequest()->getLocale());

        //Add twig global variables
        $this->addTwigGlobals();
    }

    public function addTwigGlobals() {
        $em = $this->container->get('doctrine.orm.entity_manager');
        $konfiguracja = $this->container->get("app.main.konfiguracja")->getKonfiguracja();

        //Add avaialble language to twig template as a global variable
        $this->container->get('twig')->addGlobal('konfiguracja', $konfiguracja);
    }

    public static function getSubscribedEvents() {
        return array(
            // must be registered before the default Locale listener
            KernelEvents::REQUEST => array(array('onKernelRequest', 17)),
        );
    }

}
