<?php

namespace Backend\PoiBundle\Admin;

use Backend\CommonBundle\Form\DateRangeType;
use Knp\Menu\ItemInterface as MenuItemInterface;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Admin\AdminInterface;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Show\ShowMapper;

class PoiAdmin extends Admin {

    protected $maxPerPage = 150;
    protected $datagridValues = array(
	'_sort_order' => 'DESC',
	'_sort_by' => 'updatedAt',
    );

    protected function configureListFields(ListMapper $listMapper) {
	$listMapper
		->addIdentifier('id')
		->addIdentifier('nazwa')
		->add('status_poi')
		->add('updated_at')
		->add('user')
		->add('_action', 'actions', array(
		    'actions' => array(
			'edit' => array(),
			'show' => array(),
			'delete' => array())));
    }

    protected function configureDatagridFilters(DatagridMapper $datagrid) {
	$datagrid
		->add('id')
		->add('nazwa')
		->add('ulica')
		->add('nrdomu')
		->add('status_poi', 'doctrine_orm_string', array(), 'choice', array(
		    'choices' => array(
			'w edycji' => 'W edycji',
			'zgloszony' => 'Zgłoszony',
			'zaakceptowany' => 'Zaakceptowany',
			'opublikowany' => 'Opublikowany',
			'odrzucony' => 'Odrzucony')))
		->add('poi_category.category', null, array(), null, array(
		    'multiple' => true
	));
    }

    protected function configureFormFields(FormMapper $formMapper) {
	$sezonowosc = array();
	if (!is_array($this->getSubject()->getSezonowosc()))
	{
	    $sezonowosc = json_decode($this->getSubject()->getSezonowosc());
	    if (!is_array($sezonowosc))
	    {
		$sezonowosc = array();
	    }
	}

	$formMapper
		->tab('Informacje podstawowe')
		->with('Informacje podstawowe', array("class" => "col-md-8"))
		->add('nazwa')
		->add('poi_category', 'sonata_type_collection', array(
		    'cascade_validation' => true), array(
		    'edit' => 'inline',
		    'by_reference' => false,
		    'inline' => 'table',
		    'sortable' => 'position',
		    'admin_code' => 'sonata.admin.poi_category'))
		->add('status_poi', 'choice', array('choices' =>
		    array('w edycji' => 'W edycji',
			'zgloszony' => 'Zgłoszony',
			'zaakceptowany' => 'Zaakceptowany',
			'opublikowany' => 'Opublikowany',
			'odrzucony' => 'Odrzucony')))
		->end()
		->with('Wprowadzający (Autor)', array("class" => "col-md-4"))
		->add('user', 'sonata_type_model_list')
		->add('wprowadzajacy_nazwa', null, array('help' => 'Jeśli brakuje użytkownika w systemie'))
		->add('wprowadzajacy_kontakt', null, array('help' => 'Jeśli brakuje użytkownika w systemie'))
		->add('zrodlo')
		->end()
		->with('Kontakt', array("class" => "col-md-4"))
		->add('nrtel')
		->add('nrfax', 'text', array('required' => false))
		->add('email', 'text', array('required' => false))
		->add('www', 'text', array('required' => false))
		->end()
		->with('Adres', array("class" => "col-md-8"))
		->add('adres')
		->end()
		->with('Geolokalizacja')
		->add('wgs_x', 'text', array('required' => false))
		->add('wgs_y', 'text', array('required' => false))
		->end()
		->end()
		->tab('Opis')
		->add('polozenie', 'ckeditor', array('required' => false))
		->add('opis', 'ckeditor', array('required' => false))
		->end()
		->end()
		->tab('Dostępność')
		->with('Dostępność', array("class" => "col-md-4"))
		->add('sezonowosc', 'sonata_type_native_collection', array(
		    'help' => "Format: DD-MM-YYY",
		    'type' => new DateRangeType(),
		    'allow_add' => true,
		    'allow_delete' => true,
		    'data' => $sezonowosc,
		    'required' => false,
		    'options' => array(
			'label' => "Wprowadź datę",
			'data' => $sezonowosc,
		    )
		))
		->add('wwwdod_nazwa', null, array('required' => false))
		->add('wwwdod', null, array('required' => false))
		->add('wwwdod_opis', null, array('required' => false))
		->add('dladzieci')
		->add('dlaniepelnosprawnych')
		->add('wstep', 'choice', array('choices' => array(
			'Wolny' => 'Wolny',
			'Płatny' => 'Płatny',
			'nie dotyczy' => "Nie dotyczy")))
		->end()
		->end();
	if ($this->id($this->getSubject()))
	{
	    $formMapper->tab('Powiązania')
		    ->with('Powiązania')
		    ->add('poi_media', 'sonata_type_collection', array(
			'cascade_validation' => true,
			'required' => false), array(
			'edit' => 'inline',
			'inline' => 'table',
			'sortable' => 'position',
			'admin_code' => 'sonata.admin.poi_media'))
		    ->end()
		    ->end();
	}

	$fields = array(
	    'nazwa' => array('field_type' => 'text'),
	    'alias' => array('field_type' => 'text'),
	    'polozenie' => array('field_type' => 'ckeditor'),
	    'opis' => array('field_type' => 'ckeditor')
	);

	if ($this->id($this->getSubject()))
	{
	    $fields['status_poi'] = array(
		'field_type' => 'choice',
		'choices' => array(
		    'w edycji' => 'W edycji',
		    'zgloszony' => 'Zgłoszony',
		    'zaakceptowany' => 'Zaakceptowany',
		    'opublikowany' => 'Opublikowany',
		    'odrzucony' => 'Odrzucony'
	    ));
	}
	else
	{
	    $fields['status_poi'] = array(
		'field_type' => 'hidden');
	}

	$formMapper->tab('Tłumaczenia')
		->add('translations', 'a2lix_translations_gedmo', array(
		    'translatable_class' => 'Backend\PoiBundle\Entity\Poi',
		    'required' => false,
		    'by_reference' => false,
		    'fields' => $fields
		))
		->end()
		->end();
    }

    protected function configureShowFields(ShowMapper $showMapper) {
	$showMapper->with('Informacje podstawowe', array("class" => "col-md-8"))
		->add('nazwa', null, array('safe' => true))
		->add('poi_category')
		->add('polozenie')
		->add('opis')
		->add('nrtel')
		->add('nrfax')
		->add('email')
		->add('www')
		->end()
		->with('Dostępność', array("class" => "col-md-4"))
		->add('dladzieci')
		->add('dlaniepelnosprawnych')
		->add('wstep')
		->end()
		->with('Wprowadzający', array("class" => "col-md-4"))
		->add('user')
		->add('wprowadzajacy_nazwa')
		->add('wprowadzajacy_kontakt')
		->add('zrodlo')
		->end()
		->with('Adres', array("class" => "col-md-4"))
		->add('miejscowosc')
		->add('ulica')
		->add('nrdomu')
		->add('miejscowosc_poczta')
		->add('kod_pocztowy')
		->end()
//                                ->end()
		->with('Geolokalizacja')
		->add('wgs_x')
		->add('wgs_y')
		->end()
		->with('Powiązania')
		->add('poi_media')
		->end();
    }

    public function getExportFields() {
	return array('Id' => 'id', 'Nazwa' => 'nazwa', 'Rodzaj główny' => 'glownyRodzaj', 'Rodzaje pozostałe' => 'innyRodzajStr', 'Miejscowosc' => 'getExportMiejscowosc', 'Ulica' => 'getAdresUlica', 'Numer Domu' => 'getNumerDomu', 'X' => 'wgsX', 'Y' => 'wgsY');
    }

    public function prePersist($object) {
	$object->setSezonowosc(json_encode($object->getSezonowosc()));
	$this->generujAlias($object);
	$user = $this->getConfigurationPool()->getContainer()->get('security.token_storage')->getToken()->getUser();
	$object->setCreatedByUser($user);
	$object->setModifiedByUser($user);
	$object->setStatusPoi('w edycji');
	if ($this->id($this->getSubject()))
	{
	    foreach ($object->getPoiMedia() as $AB)
	    {
		$AB->setPoi($object);
	    }
	    foreach ($object->getPoiCategory() as $AC)
	    {
		$AC->setPoi($object);
	    }
	}

	//        $this->saveMiniatura($object);
    }

    public function preUpdate($object) {
	$sezonowosc = array_values($object->getSezonowosc());
	$object->setSezonowosc(json_encode($sezonowosc));
	$this->generujAlias($object);
	$user = $this->getConfigurationPool()->getContainer()->get('security.token_storage')->getToken()->getUser();
	$object->setModifiedByUser($user);
	if ($this->id($this->getSubject()))
	{
	    foreach ($object->getPoiMedia() as $AB)
	    {
		$AB->setPoi($object);
	    }
	    foreach ($object->getPoiCategory() as $AC)
	    {
		$AC->setPoi($object);
	    }
	}
    }

    protected function configureRoutes(RouteCollection $collection) {
	$collection->add('przypiszpliki', $this->getRouterIdParameter() . '/edit/przypiszpliki');
	$collection->add('kopia_robocza', $this->getRouterIdParameter() . '/kopia_robocza');
	$collection->add('edituploadify', $this->getRouterIdParameter() . '/edit/uploadify');
	$collection->add('upload', $this->getRouterIdParameter() . '/edit/upload');
	$collection->add('wiodace', $this->getRouterIdParameter() . '/edit/uploadify/wiodace');
	$collection->add('edytujzdjecie', $this->getRouterIdParameter() . '/edit/uploadify/edytuj');
	$collection->add('usunzdjecie', $this->getRouterIdParameter() . '/edit/uploadify/usun');
	$collection->add('comment', $this->getRouterIdParameter() . '/edit/comment/{status}');
	$collection->add('addcomment', $this->getRouterIdParameter() . '/edit/addcomment');
	$collection->add('editcomment', $this->getRouterIdParameter() . '/edit/editcomment');
	$collection->add('deletecomment', $this->getRouterIdParameter() . '/edit/deletecomment');
	$collection->add('miniatura', $this->getRouterIdParameter() . '/edit/miniatura');
	$collection->add('przypiszzdjecia', $this->getRouterIdParameter() . '/edit/przypiszzdjecia');
	$collection->add('facebook', $this->getRouterIdParameter() . '/facebook');
	$collection->add('podgladReal', $this->getRouterIdParameter() . '/edit/podgladreal');
	$collection->add('historia', $this->getRouterIdParameter() . '/edit/historia');
	$collection->add('historia_porownaj', $this->getRouterIdParameter() . '/edit/historia_porownaj/{wersja_porownanie}');
	$collection->add('historia_revert', $this->getRouterIdParameter() . '/edit/historia_revert/{wersja}');
	$collection->add('zatwierdz_kopie', $this->getRouterIdParameter() . '/zatwierdz_kopie');
    }

    protected function configureSideMenu(MenuItemInterface $menu, $action, AdminInterface $childAdmin = null) {
	if (!in_array($action, array('edit', 'view')))
	{
	    return;
	}

	$admin = $this->isChild() ? $this->getParent() : $this;

	$id = $this->getRequest()->get('id');
	if ($this->getSubject())
	{
	    $status = $this->getSubject()->getStatusPoi();
	}
	else
	{
	    $status = 'w-edycji';
	}

	$menu->addChild(
		'podgladReal', array(
	    'uri' => $admin->generateUrl('podgladReal', array('id' => $id)), 'label' => 'Podgląd')
	);
    }

    public function getBatchActions() {
	// retrieve the default (currently only the delete action) actions
	$actions = parent::getBatchActions();

	return $actions;
    }

    public function getNewInstance() {
	if (!$this->getSubject())
	{
	    $user = $this->getConfigurationPool()->getContainer()
			    ->get('security.token_storage')->getToken()->getUser();
	    $instance = parent::getNewInstance();
	    $instance->setUser($user);
	    $instance->setWstep("nie dotyczy");
	    return $instance;
	}
    }

    public function createQuery($context = 'list') {
	$query = parent::createQuery($context);

	return $query;
    }

    public function postPersist($object) {

    }

    public function postUpdate($object) {

    }

    public function generujAlias($object) {
	if (!$object->getAlias())
	{
	    $object->setAlias($this->getConfigurationPool()->getContainer()->get('helper.alias.generator')->generate($object->getNazwa()));
	}
	else
	{
	    $object->setAlias($this->getConfigurationPool()->getContainer()->get('helper.alias.generator')->generate($object->getAlias()));
	}

	if ($object->getTranslations())
	{
	    foreach ($object->getTranslations() as $tr)
	    {
		if ($tr->getField() == 'alias')
		{
		    $alias = $tr->getContent();
		    if (!empty($alias))
		    {
			$tr->setContent($this->getConfigurationPool()->getContainer()->get('helper.alias.generator')->generate($tr->getContent(), $tr->getLocale() == 'ru'));
		    }
		    else
		    {
			foreach ($object->getTranslations() as $tr2)
			{
			    if ($tr2->getField() == 'nazwa' && $tr2->getLocale() == $tr->getLocale())
			    {
				$title = $tr2->getContent();
				if (!empty($title))
				{
				    $tr->setContent($this->getConfigurationPool()->getContainer()->get('helper.alias.generator')->generate($tr2->getContent(), $tr->getLocale() == 'ru'));
				}
			    }
			}
		    }
		}
	    }
	}
    }

}
