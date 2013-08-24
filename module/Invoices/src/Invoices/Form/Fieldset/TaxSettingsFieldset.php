<?php
namespace Invoices\Form\Fieldset;

use Doctrine\Common\Persistence\ObjectManager;

use DoctrineModule\Persistence\ObjectManagerAwareInterface;

use Invoices\Entity\Tax as TaxEntity;


use Zend\Form\Fieldset;

use Zend\Stdlib\Hydrator\ClassMethods as ClassMethodsHydrator;

class TaxSettingsFieldset extends Fieldset
{

	public function __construct()
    {
		parent::__construct('tax');
        //$this->setHydrator(new ClassMethodsHydrator(false))
        //     ->setObject(new TaxEntity());
        
        $this->add(array(
            'name'       => 'id',
     		'type'       => 'Zend\Form\Element\Hidden',
        ));
        
        $this->add(array(
            'name'       => 'description',
     		'type'       => 'Zend\Form\Element\Text',
            'attributes' => array(
        		'class'    => 'input-large',
            )
        ));
        
        $this->add(array(
            'name'       => 'percentage',
     		'type'       => 'Zend\Form\Element\Text',
            'attributes' => array(
        		'class'    => 'formTextMini',
        		'maxlength' => '7'
            )
        ));
        
        $this->add(array(
            'name'       => 'equalization',
     		'type'       => 'Zend\Form\Element\Text',
            'attributes' => array(
        		'class'    => 'formTextMini',
        		'maxlength' => '7'
            )
        ));
        
        $this->add(array(
            'name'       => 'active',
     		'type'       => 'Zend\Form\Element\Checkbox',
        ));
    }

}