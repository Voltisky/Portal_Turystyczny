<?php

namespace Backend\AdministracyjneBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class AdresAdmin extends AbstractAdmin {

    protected $datagridValues = array(
	'_sort_order' => 'ASC',
	'_sort_by' => 'nazwa',
    );

    protected function configureDatagridFilters(DatagridMapper $datagrid) {
	$datagrid
		->add('sym')
		->add('sym_pod')
		->add('teryt')
		->add('nazwa_woj')
		->add('nazwa_pow')
		->add('nazwa_gmi')
		->add('nazwa_dod')
		->add('rodzaj_gmi')
		->add('woj')
		->add('pow')
		->add('gmi')
		->add('rm')
		->add('mz')
		->add('nazwa')
		->add('stan_na')
	;
    }

    protected function configureFormFields(FormMapper $formMapper) {
	$formMapper
		->add('sym')
		->add('sym_pod')
		->add('teryt')
		->add('nazwa_woj')
		->add('nazwa_pow')
		->add('nazwa_gmi')
		->add('woj')
		->add('pow')
		->add('gmi')
		->add('nazwa_dod')
		->add('rodzaj_gmi')
		->add('rm')
		->add('mz')
		->add('nazwa')
		->add('stan_na', DateType::class, array(
		    // render as a single text box
		    'widget' => 'single_text',
		))
	;
    }

    protected function configureListFields(ListMapper $listMapper) {
	$listMapper
		->addIdentifier('nazwa')
		->add('nazwa_woj')
		->add('nazwa_pow')
		->add('nazwa_gmi')
		->add('woj')
		->add('pow')
		->add('gmi')
		->add('teryt')
		->add('_action', 'actions', array(
		    'actions' => array('edit' => array(), 'show' => array(), 'delete' => array())))
	;
    }

    protected function configureShowFields(ShowMapper $showMapper) {
	$showMapper
		->add('sym')
		->add('sym_pod')
		->add('teryt')
		->add('woj')
		->add('pow')
		->add('gmi')
		->add('nazwa_woj')
		->add('nazwa_pow')
		->add('nazwa_gmi')
		->add('nazwa_dod')
		->add('rodzaj_gmi')
		->add('rm')
		->add('mz')
		->add('nazwa')
		->add('stan_na')
		->end();
    }

}
