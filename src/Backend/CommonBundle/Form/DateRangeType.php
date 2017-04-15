<?php

namespace Backend\CommonBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class DateRangeType extends AbstractType {

    private $count_array = 0;
    private $i = 0;

    public function buildForm(FormBuilderInterface $builder, array $options) {
	$builder
		->add('data_od', 'sonata_type_date_picker', array(
		    'format' => 'd-M-y',
		))
		->add('data_do', 'sonata_type_date_picker', array(
		    'format' => 'd-M-y',
	));

	$builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
	    //            print_r($event->getData()); exit;
//                $this->count_array++;

	    $data = $event->getData();
	    if (!is_null($data) && is_array($data)) {
		if (array_key_exists($this->count_array, $data) && is_object($data[$this->count_array])) {
		    if ($this->count_array == 0) {
			++$this->i;
		    }
		    if ($this->i > 2) {
			++$this->count_array;
		    }
		    if (isset($event->getData()[$this->count_array])) {
			$data_od = $event->getData()[$this->count_array]->data_od;
			$data_do = $event->getData()[$this->count_array]->data_do;
			//                exit;
			$form = $event->getForm();
			$data_od = new \DateTime($data_od->date);
			$data_do = new \DateTime($data_do->date);

			$form->add('data_od', 'sonata_type_date_picker', array(
			    'data' => $data_od,
			    'format' => 'd-M-y',
			));
			$form->add('data_do', 'sonata_type_date_picker', array(
			    'data' => $data_do,
			    'format' => 'd-M-y',
			));
			if ($this->count_array == count($event->getData()) - 1) {
			    $this->count_array = count($event->getData()) - 1;
			}
		    }
		}
	    }
	});
	$builder->addEventListener(FormEvents::SUBMIT, function (FormEvent $event) {
	    $user = $event->getData();
	    $form = $event->getForm();

	    if (is_array($user)) {
		$event->setData(array('data_od' => $user['data_od'], 'data_do' => $user['data_do']));
	    }
	    $this->count_array = 0;
	    $this->i = 0;
	});
    }

    public function getName() {
	return 'dateRange';
    }

    public function preSetData(FormEvent $event) {
	$product = $event->getData();
	$form = $event->getForm();

	if (!$product || null === $product->getId()) {
	    $form->add('name', 'text');
	}
    }

}
