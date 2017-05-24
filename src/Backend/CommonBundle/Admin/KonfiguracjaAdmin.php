<?php

/*
 * This file is part of the Sonata package.
 *
 * (c) Thomas Rabaix <thomas.rabaix@sonata-project.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Backend\CommonBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Show\ShowMapper;

class KonfiguracjaAdmin extends Admin {

    protected function configureShowFields(ShowMapper $show) {
        $show
                ->add("nazwa")
                ->add('opis')
                ->add('main');
    }

    protected function configureListFields(ListMapper $list) {
        $list
                ->addIdentifier("nazwa")
                ->add('opis')
                ->add('main')
                ->add('_action', 'actions', array(
                    'actions' => array(
                        'edit' => array(),
                        'show' => array(),
                        'delete' => array())));
    }

    /**
     * @param \Sonata\AdminBundle\Form\FormMapper $formMapper
     *
     * @return void
     */
    protected function configureFormFields(FormMapper $formMapper) {
        $link_parameters = array();
        $fields = array(
            "nazwa" => array("field_type" => "text"),
            "opis" => array("field_type" => "ckeditor")
        );

        $formMapper->tab("Informacje szczegółowe")
                ->add("nazwa")
                ->add("opis", "ckeditor")
                ->add("main")
                ->add("logo", "sonata_type_model_list")
                ->add("default_image", "sonata_type_model_list")
                ->end()
                ->end()
                ->tab('Tłumaczenia')
                ->add('translations', 'a2lix_translations_gedmo', array(
                    'translatable_class' => 'Backend\CommonBundle\Entity\Konfiguracja',
                    'required' => false,
                    'by_reference' => false,
                    'fields' => $fields
                ))
                ->end();
    }

}
