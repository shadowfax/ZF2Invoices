<?php
namespace Invoices\Form\Fieldset;

use Invoices\Entity\Product as ProductEntity;
use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Stdlib\Hydrator\ClassMethods as ClassMethodsHydrator;

class Product extends Fieldset implements InputFilterProviderInterface
{
    public function __construct()
    {
        parent::__construct('product');
        $this->setHydrator(new ClassMethodsHydrator(false))
             ->setObject(new ProductEntity());

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
        
        $this->add(array(
			'name' => 'taxId',
			'type'  => 'Zend\Form\Element\Select',
        	'options' => array(
                'label' => 'Tax',
        		'label_attributes' => array(
        			'class' => 'control-label'
        		)
            ),
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