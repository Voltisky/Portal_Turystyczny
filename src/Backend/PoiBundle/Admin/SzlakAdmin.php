<?php

namespace Backend\PoiBundle\Admin;

use Backend\PoiBundle\Admin\PoiAdmin;
use Knp\Menu\ItemInterface as MenuItemInterface;
use Sonata\AdminBundle\Admin\AdminInterface;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class SzlakAdmin extends PoiAdmin {

    protected function configureShowFields(ShowMapper $showMapper) {
	// Here we set the fields of the ShowMapper variable, $showMapper (but this can be called anything)
	$showMapper
		->add('id')
		->add('nazwa')
		->add('polozenie')
		->add('opis')
		->add('created_by_user')
		->add('wprowadzajacy_nazwa')
		->add('wprowadzajacy_kontakt')
		->add('zrodlo')
		->add('dlugosc')
		->add('czaspodrozy')
		->end()
		->with('Geolokalizacja')
		->add('u92_x_s', null, array('label' => "współrzędne początku (u 92) - x"))
		->add('u92_y_s', null, array('label' => "współrzędne początku (u 92) - y"))
		->add('wgs_x_s', null, array('label' => "współrzędne początku (u 92) - x"))
		->add('wgs_y_s', null, array('label' => "współrzędne początku (u 92) - y"))
		->add('u92_x_k', null, array('label' => "współrzędne końca (WGS 84) - x"))
		->add('u92_y_k', null, array('label' => "współrzędne końca (WGS 84) - y"))
		->add('wgs_x_k', null, array('label' => "współrzędne końca (WGS 84) - x"))
		->add('wgs_y_k', null, array('label' => "współrzędne końca (WGS 84) - y"));
    }

    protected function configureDatagridFilters(DatagridMapper $datagrid) {
	parent::configureDatagridFilters($datagrid);
    }

    protected function configureFormFields(FormMapper $formMapper) {
	parent::configureFormFields($formMapper);
	$this->setTemplate('edit', 'BackendPoiBundle:Extended:sonata_edit_szlaki.html.twig');
	$formMapper
		->remove('wgs_x')
		->remove('wgs_y')
		->remove('u92_x')
		->remove('u92_y')
	;

	$formMapper->tab("Dostępność")
		->with("Dostępność")
		->add('dlugosc', null, array("help" => "[m]"))
		->end()
		->end();
	$formMapper->tab("Informacje podstawowe");
	$formMapper->with('Geolokalizacja', array( "class" => "col-md-12 geolokalizacja"))
		->add("geometria", "hidden", array("attr" => array("hidden" => true)))
		->end()
		->end();

	if ($this->id($this->getSubject()))
	{

	    $formMapper->tab('Powiązania');
	    $formMapper->with('Powiązania')
		    ->add('etapy_szlak', 'sonata_type_collection', array(
			'cascade_validation' => true,
			'required' => false), array(
			'edit' => 'inline',
			'inline' => 'table',
			'sortable' => 'position',
			'admin_code' => 'sonata.admin.etap'))
		    ->end()
		    ->end();
	}
    }

    public function getExportFormats() {
	return array(
	    'xls', 'csv', 'xml'
	);
    }

    public function getExportFields() {
	return array('Id' => 'id', 'Nazwa' => 'nazwa');
    }

    public function prePersist($object) {
	parent::prePersist($object);
	if ($this->id($this->getSubject()))
	{
	    foreach ($object->getEtapySzlak() as $AB)
	    {
		$AB->setSzlak($object);
	    }
	}
    }

    public function postPersist($object) {
	parent::postPersist($object);
    }

    public function preUpdate($object) {
	parent::preUpdate($object);
	$user = $this->getConfigurationPool()->getContainer()->get('security.token_storage')->getToken()->getUser();
	$object->setModifiedByUser($user);
	if ($this->id($this->getSubject()))
	{
	    foreach ($object->getEtapySzlak() as $AB)
	    {
		$AB->setSzlak($object);
	    }
	}
    }

    protected function configureSideMenu(MenuItemInterface $menu, $action, AdminInterface $childAdmin = null) {
	parent::configureSideMenu($menu, $action);
    }

    public function getNewInstance() {
	if (!$this->getSubject())
	{
	    $user = $this->getConfigurationPool()->getContainer()->get('security.token_storage')->getToken()->getUser();
	    $instance = parent::getNewInstance();
	    $instance->setUser($user);

	    return $instance;
	}
    }

}
