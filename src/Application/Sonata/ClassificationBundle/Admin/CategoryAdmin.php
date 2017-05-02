<?php

namespace Application\Sonata\ClassificationBundle\Admin;

use Knp\Menu\ItemInterface as MenuItemInterface;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Admin\AdminInterface;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\ClassificationBundle\Admin\CategoryAdmin as CategoryAdminBase;

class CategoryAdmin extends CategoryAdminBase {

    protected function configureFormFields(FormMapper $formMapper) {
	$formMapper
		->with('General', array('class' => 'col-md-6'))
		->add('name')
		->add('description', 'textarea', array(
		    'required' => false,
		))
	;

	if ($this->hasSubject())
	{
	    if ($this->getSubject()->getParent() !== null || $this->getSubject()->getId() === null)
	    { // root category cannot have a parent
		$formMapper
			->add('parent', 'sonata_category_selector', array(
			    'category' => $this->getSubject() ?: null,
			    'model_manager' => $this->getModelManager(),
			    'class' => $this->getClass(),
			    'required' => true,
			    'context' => $this->getSubject()->getContext(),
			    'choices_as_values' => true
		));
	    }
	}

	$position = $this->hasSubject() && !is_null($this->getSubject()->getPosition()) ? $this->getSubject()->getPosition() : 0;

	$formMapper
		->end()
		->with('Options', array('class' => 'col-md-6'))
		->add('enabled', null, array(
		    'required' => false,
		))
		->add('position', 'integer', array(
		    'required' => false,
		    'data' => $position,
		))
		->end()
	;

	if (interface_exists('Sonata\MediaBundle\Model\MediaInterface'))
	{
	    $formMapper
		    ->with('General')
		    ->add('media', 'sonata_type_model_list', array(
			'required' => false,
			    ), array(
			'link_parameters' => array(
			    'provider' => 'sonata.media.provider.image',
			    'context' => 'sonata_category',
			),
			    )
		    )
		    ->end();
	}
    }

}
