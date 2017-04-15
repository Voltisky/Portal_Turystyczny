<?php

/*
 * This file is part of the Sonata package.
 *
 * (c) Thomas Rabaix <thomas.rabaix@sonata-project.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Backend\PoiBundle\Admin;

use Common\ComponentsBundle\Helper\MediaPathHelper;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;

class EtapAdmin extends Admin {

    /**
     * @param \Sonata\AdminBundle\Form\FormMapper $formMapper
     *
     * @return void
     */
    protected function configureFormFields(FormMapper $formMapper) {
	$link_parameters = array();
	$formMapper
		->add("dlugosc")
		->add('rodzaj', 'choice', array('choices' =>
		    array('etap.rowerowy' => 'Etap rowerowy',
			'etap.pieszy' => 'Etap pieszy',
			'etap.samochodowy' => 'Etap samochodowy',
			'etap.zeglugowy' => 'Etap żeglugowy',
			'etap.kajakowy' => 'Etap kajakowy')))
		->add("style", 'hidden', array('attr' => array('hidden' => true)))
		->add("wspolrzedne", 'hidden', array('attr' => array('hidden' => true)))
		->add('powiazanie', 'choice', array('choices' =>
		    array('poi' => 'Poi',
			'media' => 'Media')))
		->add('nazwa')
		->add('opis')
		->add('poi', 'sonata_type_model_list')
		->add('media', 'sonata_type_model_list')
		->add('position', 'hidden')
		->add('stan', 'hidden', array('attr' => array('hidden' => true, 'class' => 'stanPozycji')));
    }

    public function prePersist($object) {
	$object->setRodzaj("etap.rowerowy");
    }

    public function preUpdate($object) {
	$object->setRodzaj("etap.rowerowy");
    }

}
