<?php

namespace Invoices\Form;


use Invoices\Service\TaxService;

use Doctrine\Common\Collections\ArrayCollection;

use Zend\Form\Form;
use Zend\Form\FormInterface;
use DoctrineModule\Persistence\ObjectManagerAwareInterface;
use Doctrine\Common\Persistence\ObjectManager;

use Invoices\Entity\Tax as TaxEntity;
use Invoices\Form\Fieldset\TaxSettingsFieldset;

use Zend\Stdlib\Hydrator\ClassMethods as ClassMethodsHydrator;


class TaxSettings extends Form
{
	
	protected $taxService;
	
 
    public function getTaxService()
    {
        return $this->taxService;
    }
    
    public function __construct(TaxService $taxService)
    {
    	$this->taxService = $taxService;
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
        $taxes = $this->getTaxService()->findAll();
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