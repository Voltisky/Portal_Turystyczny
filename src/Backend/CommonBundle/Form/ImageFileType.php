<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Backend\CommonBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\Form\FormView;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ImageFileType extends AbstractType {

    /**
     * {@inheritdoc}
     */
    public function buildView(FormView $view, FormInterface $form, array $options) {
	$view->vars = array_replace($view->vars, array(
	    'type' => 'text',
	    'value' => '',
	    'absolute' => $options['absolute'],
	    'path' => $options['path'],
	    'filter' => $options['filter'],
	    'admin' => $options['admin'],
	    'object' => $options['object']
	));
    }

    /**
     * {@inheritdoc}
     */
    public function finishView(FormView $view, FormInterface $form, array $options) {
	$view
		->vars['multipart'] = true
	;
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
	$resolver->setDefaults(array(
	    'path' => null,
	    'absolute' => false,
	    'filter' => null,
	    'compound' => false,
	    'admin' => null,
	    'object' => null
	));
    }

    /**
     * {@inheritdoc}
     */
    public function getParent() {
	return 'text';
    }

    /**
     * {@inheritdoc}
     */
    public function getName() {
	return 'imageFile';
    }

}
