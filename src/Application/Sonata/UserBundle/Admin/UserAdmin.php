<?php

namespace Application\Sonata\UserBundle\Admin;

use Knp\Menu\ItemInterface as MenuItemInterface;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Admin\AdminInterface;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\UserBundle\Admin\Model\UserAdmin as UserAdminBase;

class UserAdmin extends UserAdminBase {

    protected function configureFormFields(FormMapper $formMapper) {
	parent::configureFormFields($formMapper);

	$formMapper->with('Groups')
		->add('groups', 'entity', array(
		    'class' => 'Application\Sonata\UserBundle\Entity\Group'
		))
		->end();
    }

}
