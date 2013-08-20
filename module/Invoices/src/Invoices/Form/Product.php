<?php
namespace Invoices\Form;


use Invoices\Form\Fieldset\TaxesFieldset;

use Zend\InputFilter\InputFilterProviderInterface;


use Zend\Form\Form;
use Zend\Form\FormInterface;
use Zend\InputFilter\InputFilter;
use Zend\Stdlib\Hydrator\ClassMethods as ClassMethodsHydrator;
use DoctrineModule\Persistence\ObjectManagerAwareInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Invoices\Entity\Product as ProductEntity;

class Product extends Form implements ObjectManagerAwareInterface, InputFilterProviderInterface
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
        parent::__construct('product');

        $this->setAttribute('method', 'post')
             ->setAttribute('class', 'form-horizontal')
             ->setHydrator(new ClassMethodsHydrator(false))
             ->setInputFilter(new InputFilter())
             ->setObject(new ProductEntity());;

        $this->add(array(
            'name' => 'name',
            'options' => array(
                'label' => 'Item Name',
                'label_attributes' => array(
        			'class' => 'control-label'
        		)
            ),
            'attributes' => array(
                'required' => 'required'
            )
        ));
        
        $this->add(array(
			'name' => 'itemType',
			'type'  => 'Zend\Form\Element\Select',
        	'options' => array(
                'label' => 'Item Type',
        		'label_attributes' => array(
        			'class' => 'control-label'
        		)
            ),
		));

        $this->add(array(
            'name' => 'description',
        	'type'  => 'Zend\Form\Element\TextArea',
            'options' => array(
                'label' => 'Description',
                'label_attributes' => array(
        			'class' => 'control-label'
        		)
            ),
        ));
        
        $this->add(array(
            'name' => 'unitPrice',
            'options' => array(
                'label' => 'Unit Price',
        		'label_attributes' => array(
        			'class' => 'control-label'
        		)
            ),
            'attributes' => array(
            	'class'    => 'input-mini',
                'required' => 'required'
            )
        ));
        
        $this->add(array(
            'name' => 'unitCost',
            'options' => array(
                'label' => 'Unit Cost',
        		'label_attributes' => array(
        			'class' => 'control-label'
        		)
            ),
            'attributes' => array(
            	'class'    => 'input-mini'
            )
        ));
        
        $taxesFieldset = new TaxesFieldset($this->getObjectManager());
        $taxesFieldset->setOptions(array(
        	'use_as_base_fieldset'  =>  false , 
        ));
        //$taxesFieldset->setObject($this->getObject()->getTaxes());
        
        $this->add(array(
            'type' => 'Zend\Form\Element\Collection',
            'name' => 'taxes',
            'options' => array(
                'label' => 'Please choose taxes for this product',
                'count' => 1,
                'should_create_template' => true,
                'allow_add' => true,
                'target_element' => $taxesFieldset,
            )
        ));
        
        // http://samminds.com/2013/03/zendformelementselect-and-database-values/
		

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
    
    
	/**
     * Should return an array specification compatible with
     * {@link Zend\InputFilter\Factory::createInputFilter()}.
     *
     * @return array
     \*/
    public function getInputFilterSpecification()
    {
        return array(
            'name' => array(
                'required' => true,
            ),
        );
    }
    
}