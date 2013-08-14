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
                'label' => 'Name'
            ),
            'attributes' => array(
                'required' => 'required'
            )
        ));

        $this->add(array(
            'name' => 'description',
            'options' => array(
                'label' => 'Description'
            ),
        ));
        
        $this->add(array(
            'name' => 'unitPrice',
            'options' => array(
                'label' => 'Price'
            ),
            'attributes' => array(
                'required' => 'required'
            )
        ));
        
        $this->add(array(
            'name' => 'unitCost',
            'options' => array(
                'label' => 'Cost'
            ),
        ));
        
        $this->add(array(
			'name' => 'taxId',
			'type'  => 'Zend\Form\Element\Select',
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