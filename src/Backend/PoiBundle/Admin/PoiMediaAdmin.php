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

use Backend\CommonBundle\Helper\MediaPathHelper;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;

class PoiMediaAdmin extends Admin {

    /**
     * @param FormMapper $formMapper
     *
     * @return void
     */
    protected function configureFormFields(FormMapper $formMapper) {

	$link_parameters = array();

	if ($this->hasParentFieldDescription())
	{
	    $link_parameters = $this->getParentFieldDescription()->getOption('link_parameters', array());
	}

	if ($this->hasRequest())
	{
	    $context = $this->getRequest()->get('context', null);

	    if (null !== $context)
	    {
		$link_parameters['context'] = $context;
	    }
	}
	// To Do - poprawienie ścieżki
	if ($this->getSubject() && $this->getSubject()->getMedia())
	{
	    $mediaHelper = new MediaPathHelper;
	    $mediaSubj = $this->getSubject()->getMedia();
	    $path = $mediaHelper->getMediaPath($mediaSubj
			    ->getId(), $mediaSubj
			    ->getProviderReference(), $mediaSubj
			    ->getProviderName(), true, $mediaSubj
			    ->getContext());
//        $path = $this->getConfigurationPool()->getContainer()->get('sonata.media.twig.extension')->path($this->getSubject()->getMedia(), 'reference');
	    $path = array('path' => $path, 'admin' => $this, 'object' => $this->getSubject()->getMedia());
	    $formMapper
		    ->add('miniatura', 'imageFile', array_merge(array('required' => false, 'label' => 'Miniatura'), $path));
	}
	else
	{
	    $path = array();
	    $formMapper->add('miniatura', 'text');
	}
	$formMapper
		->add('media', 'sonata_type_model_list', array('required' => false, 'btn_catalogue' => 'BackendKonfiguracjaBundle'))
		->add('enabled', null, array('required' => false))
		->add('czywiodaca', null, array('required' => false))
		->add('position', 'hidden')
		->add('status', null, array('required' => false));
    }

    /**
     * @param  ListMapper $listMapper
     * @return void
     */
    protected function configureListFields(ListMapper $listMapper) {
	$listMapper
		->add('media.id')
		->add('media')
		->add('media.authorName')
		->add('media.enabled')

	;
    }

    public function prePersist($object) {

    }

    public function preUpdate($object) {

    }

}
