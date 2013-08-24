<?php

namespace Invoices\Form;


use Doctrine\Common\Collections\ArrayCollection;

use Zend\Form\Form;
use Zend\Form\FormInterface;
use DoctrineModule\Persistence\ObjectManagerAwareInterface;
use Doctrine\Common\Persistence\ObjectManager;

use Invoices\Entity\Tax as TaxEntity;
use Invoices\Form\Fieldset\TaxSettingsFieldset;

use Zend\Stdlib\Hydrator\ClassMethods as ClassMethodsHydrator;


class TaxSettings extends Form implements ObjectManagerAwareInterface
{
	
	protected $objectManager;
	
	public function setObjectManager(ObjectManager $objectManager)
    {
        $this->objectManager = $objectManager;
 
        return $this;
    }
 
    public function getObjectManager()
    {
        return $this->objectManager;
    }
    
    public function __construct(ObjectManager $objectManager)
    {
    	$this->setObjectManager($objectManager);
        parent::__construct('taxes');
        
        $this->setAttribute('method', 'post')
             ->setAttribute('class', 'form-horizontal');
        
        $this->add(array(
            'type' => 'Zend\Form\Element\Collection',
            'name' => 'taxes',
            'options' => array(
                'label' => 'Please choose taxes for this product',
                'count' => 1,
                'should_create_template' => true,
                'allow_add' => true,
                'target_element' => new TaxSettingsFieldset(),
            )
        ));
        // Fill out the taxes
        $taxValues = array();
        $taxes = $this->getObjectManager()->getRepository('Invoices\Entity\Tax')->findAll();
        foreach ($taxes as $taxEntity) {
        	$taxValues[] = $taxEntity->getArrayCopy();
        }
        $this->get('taxes')->populateValues($taxValues);
        
        $this->add(array(
            'type' => 'Zend\Form\Element\Csrf',
            'name' => 'csrf'
        ));

        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
        		'class' => 'green',
                'type' => 'submit',
                'value' => 'Save'
            )
        ));
        
    }
    
    
}