<?php
/**
 * Created by PhpStorm.
 * User: Karol Włodek
 * Date: 11.05.2017
 * Time: 20:15
 */

namespace Frontend\UserBundle\Services;


use Symfony\Component\DependencyInjection\ContainerInterface;

class UserService
{
    private $container;

    public function __construct(ContainerInterfacee $container)
    {
        $this->container = $container;
    }
}