<?php
/**
 * Created by PhpStorm.
 * User: Karol Włodek
 * Date: 10.05.2017
 * Time: 20:12
 */

namespace Frontend\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SecurityController extends Controller
{
    public function loginAction()
    {
        $authenticationUtils = $this->get('security.authentication_utils');

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('@FrontendMain/User/login.html.twig', array(
            'last_username' => $lastUsername,
            'error' => $error,
        ));
    }
}