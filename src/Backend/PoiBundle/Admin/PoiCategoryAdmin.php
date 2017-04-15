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

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;

class PoiCategoryAdmin extends Admin
{

    /**
     * @param \Sonata\AdminBundle\Form\FormMapper $formMapper
     *
     * @return void
     */
    protected
	    function configureFormFields(FormMapper $formMapper)
    {
	$formMapper
		->add('category')
		->add('czyglowny', null, array('required' => false));
    }

    /**
     * @param  \Sonata\AdminBundle\Datagrid\ListMapper $listMapper
     * @return void
     */
    protected
	    function configureListFields(ListMapper $listMapper)
    {
	$listMapper
		->add('media')
		->add('nazwa')

	;
    }

}
