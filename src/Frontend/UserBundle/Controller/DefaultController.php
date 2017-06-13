<?php

namespace Frontend\UserBundle\Controller;

use Backend\PoiBundle\Entity\Poi;
use Backend\PoiBundle\Entity\PoiMedia;
use Frontend\UserBundle\Form\ObjectForm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function panelAction()
    {
        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            $this->addFlash("error", $this->get('translator')->trans("frontend.user.authentication.failed"));
            return $this->redirect($this->generateUrl("frontend_login_form"));
        }

        return $this->render('@FrontendUser/User/panel.html.twig');
    }

    public function objectListAction()
    {
        $em = $this->getDoctrine()->getManager();
        $items = array();
        $user = $this->getUser();

        try {
            $items = $em->getRepository("BackendPoiBundle:Poi")->findBy(array("user" => $user), array("id" => "DESC"));
        } catch (\Exception $e) {

        }

        return $this->render("@FrontendUser/Objects/list.html.twig", array("items" => $items));
    }

    public function editObjectAction($id)
    {
        $request = $this->get('request');
        $em = $this->getDoctrine()->getManager();

        $poi = new Poi();
        $media = null;
        try {
            $poi = $em->getRepository("BackendPoiBundle:Poi")->find($id);
        } catch (\Exception $e) {

        }
        $form = $this->get('form.factory')->create(new ObjectForm($this->container), $poi);
        if ($request->getMethod() == "POST") {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $this->addFlash("success", $this->get("translator")->trans("frontend.user.object.edit.validation.success"));
                $poi->setStatusPoi("zgloszony");
//                dump($poi); exit;
                $em->merge($poi);
                $em->flush();

                return $this->redirectToRoute("frontend_user_object_list", array("_locale" => $request->getLocale()));
            } else {
                $this->addFlash("error", $this->get("translator")->trans("frontend.user.object.validation.error"));
            }
        }

        if ($poi) {
            /**
             * @var PoiMedia $poiMedia
             */
            foreach ($poi->getPoiMedia() as $poiMedia) {
                if ($poiMedia->getCzywiodaca() == true && $poiMedia->getMedia()) {
                    $media = $poiMedia->getMedia();
                    break;
                }
            }
        }

        return $this->render("@FrontendUser/Objects/edit.html.twig", array(
            "form" => $form->createView(),
            "poi" => $poi,
            "media" => $media));
    }

    public function deleteObjectAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $tr = $this->get('translator');

        try {
            $object = $em->getRepository("BackendPoiBundle:Poi")->find($id);
            $em->remove($object);
            $em->flush();

            $this->addFlash("success", $tr->trans("frontend.user.object.delete_success"));
        } catch (\Exception $e) {
            $this->addFlash("error", $tr->trans("frontend.user.object.delete_error"));
        }

        return $this->redirectToRoute("frontend_user_object_list", array("_locale" => $this->get('request')->getLocale()));
    }

    public function createObjectAction()
    {
        $request = $this->get('request');
        $em = $this->getDoctrine()->getManager();

        $poi = new Poi();
        $form = $this->get('form.factory')->create(new ObjectForm($this->container), $poi);
        if ($request->getMethod() == "POST") {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $this->addFlash("success", $this->get("translator")->trans("frontend.user.object.create.validation.success"));
                $poi->setUser($this->getUser());
                $poi->setStatusPoi("zgloszony");

                $em->persist($poi);
                $em->flush();

                return $this->redirectToRoute("frontend_user_object_list", array("_locale" => $request->getLocale()));
            } else {
                $this->addFlash("error", $this->get("translator")->trans("frontend.user.object.validation.error"));
            }
        }

        return $this->render("@FrontendUser/Objects/create.html.twig", array(
            "form" => $form->createView()));
    }
}
