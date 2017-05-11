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
    public function getCategorySidebarAction($parentId)
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

        return $this->render("FrontendPoiBundle:Category:sidebar.html.twig", array("categories" => $categoriesById, "parentId" => $parentId));
    }

    private function generateFormCategory($categoryId)
    {
        $tr = $this->get('translator');
        $form = $this->createFormBuilder(null)
            ->add('name', TextType::class)
            ->add('address', EntityType::class, array(
                "class" => 'Backend\AdministracyjneBundle\Entity\Adres',
                "multiple" => true,
                "required" => false,
            ))
            ->add('categories', EntityType::class, array(
                "class" => 'Application\Sonata\ClassificationBundle\Entity\Category',
                'query_builder' => function (EntityRepository $er) use ($categoryId) {
                    return $er->createQueryBuilder('c')
                        ->where('c.parent = ' . $categoryId);
                },
                "multiple" => true,
                "required" => false,
            ))
            ->add('save', SubmitType::class)
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

        $categoryObject = null;
        $items = array();
        $form = $this->generateFormCategory($id);

        if ($slug) {
            try {
                $categoryObject = $em->createQuery("SELECT c, m FROM ApplicationSonataClassificationBundle:Category c 
                                                    LEFT JOIN c.media m 
                                                    WHERE c.slug = :slug AND c.id = :id")
                    ->setParameter("slug", $slug)
                    ->setParameter("id", $id)
                    ->getSingleResult();

                $items = $em->createQuery("SELECT p, pm, m, a, u, pc, c FROM BackendPoiBundle:Poi p "
                    . "LEFT JOIN p.poi_media pm WITH pm.czywiodaca = true "
                    . "LEFT JOIN pm.media m "
                    . "LEFT JOIN p.adres a "
                    . "LEFT JOIN p.user u "
                    . "LEFT JOIN p.poi_category pc "
                    . "LEFT JOIN pc.category c "
                    . "WHERE c.id = :categoryId "
                    . "ORDER BY p.updated_at DESC ")
                    ->setParameter("categoryId", $categoryObject->getId())
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
