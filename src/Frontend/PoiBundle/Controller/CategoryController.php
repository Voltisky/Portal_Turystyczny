<?php

namespace Frontend\PoiBundle\Controller;

use Doctrine\ORM\EntityRepository;
use Ivory\CKEditorBundle\Exception\Exception;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CategoryController extends Controller
{
    public function getCategorySidebarAction($parentId, $currentId = 0)
    {
        $em = $this->getDoctrine()->getManager();

        $categories = array();
        $categoriesGrouped = array();
        $categoriesById = array();
        try {
            $categories = $em->createQuery("SELECT c, p   FROM ApplicationSonataClassificationBundle:Category c
                                            LEFT JOIN c.parent p
                                            ORDER BY c.position")
                ->getResult();
        } catch (Exception $e) {

        }
//

        // Fill array of categories
        foreach ($categories as $c) {
            $categoriesById[$c->getId()] = array("data" => $c, "childrens" => array());
//            if (!$c->getParent()) continue;
//            $categoriesById[$c->getParent()->getId()] =
////            if (!isset($categoriesGrouped[$c->getParent()->getId()])) {
////                $categoriesGrouped[$c->getParent()->getId()] = array("category" => $c->getParent(), "childrens" => array());
////            }
//
////            $categoriesGrouped[$c->getParent()->getId()]["childrens"][] = $c;
        }

        // Fill category childrens
        foreach ($categories as $c) {
            if (!$c->getParent()) continue;
            $categoriesById[$c->getParent()->getId()]["childrens"][] = $c->getId();
        }

        return $this->render("FrontendPoiBundle:Category:sidebar.html.twig", array("categories" => $categoriesById, "parentId" => $parentId, "currentId" => $currentId));
    }

    private function generateFormCategory($categoryId)
    {
        $tr = $this->get('translator');
        $form = $this->createFormBuilder(null)
            ->add('name', TextType::class, array("label" => $tr->trans("frontend.name")))
            ->add('categories', EntityType::class, array(
                "label" => $tr->trans("frontend.category.list.title"),
                "class" => 'Application\Sonata\ClassificationBundle\Entity\Category',
                'query_builder' => function (EntityRepository $er) use ($categoryId) {
                    return $er->createQueryBuilder('c')
                        ->where('c.parent = ' . $categoryId);
                },
                "multiple" => true,
                "required" => false,
            ))
            ->add('save', SubmitType::class, array("label" => $tr->trans("frontend.search"), "attr" => array("class" => "btn")))
            ->getForm();

        return $form;
    }

    public function listAction($parent_id)
    {
        $em = $this->getDoctrine()->getManager();
    }

    public function getCategoryAction($id, $slug)
    {
        $em = $this->getDoctrine()->getManager();
        $request = $this->get('request');
        $tr = $this->get('translator');

        $categoryObject = null;
        $items = array();

        // Frontend/PoiBundle/Controller/CategoryController.php
        $form = $this->generateFormCategory($id);

        if ($slug) {
            try {
                $form->handleRequest($request);

                //region ...
                $categoryObject = $em->createQuery("SELECT c, m FROM ApplicationSonataClassificationBundle:Category c 
                                                LEFT JOIN c.media m 
                                                WHERE c.slug = :slug AND c.id = :id")
                    ->setParameter("slug", $slug)
                    ->setParameter("id", $id)
                    ->getSingleResult();

                $qb = $em->createQueryBuilder("p");
                $items = $qb->select("p")
                    ->from("BackendPoiBundle:Poi", "p")
                    ->addSelect("pm")->leftJoin("p.poi_media", "pm")
                    ->addSelect("m")->leftJoin("pm.media", "m")
                    ->addSelect("a")->leftJoin("p.adres", "a")
                    ->addSelect("u")->leftJoin("p.user", "u")
                    ->addSelect("pc")->leftJoin("p.poi_category", "pc")
                    ->addSelect("c")->leftJoin("pc.category", "c")
                    ->where('c.id = :categoryId')
                    ->setParameter("categoryId", $categoryObject->getId());
                //endregion

                if ($form->isSubmitted() && $form->isValid()) {
                    $formData = $form->getData();

                    if (!empty($formData["name"])) {
                        //region ...
                        $items->andWhere("SIMILARITY(p.nazwa, :similarName) > 0.5 ")
                            ->setParameter("similarName", $formData["name"]);
                        //endregion
                    }
                }

                $items = $items->getQuery()
                    ->getResult();

            } catch (Exception $e) {
                throw new NotFoundHttpException();
            }
        }

        if ($categoryObject == null) {
            throw new NotFoundHttpException();
        }

        return $this->render("FrontendPoiBundle:Category:category.html.twig", array(
            "category" => $categoryObject,
            "items" => $items,
            "form" => $form->createView()
        ));
    }

}
