<?php
namespace People\Form\Fieldset;

use Invoices\Entity\Customer as CustomerEntity;
use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Stdlib\Hydrator\ClassMethods as ClassMethodsHydrator;

class Customer extends Fieldset implements InputFilterProviderInterface
{
    public function __construct()
    {
        parent::__construct('customer');
        $this->setHydrator(new ClassMethodsHydrator(false))
             ->setObject(new CustomerEntity());

        $this->add(array(
            'name' => 'name',
            'options' => array(
                'label' => 'Organization'
            ),
            'attributes' => array(
                'required' => 'required'
            )
        ));

        $this->add(array(
            'name' => 'taxId',
            'options' => array(
                'label' => 'Tax ID'
            ),
            'attributes' => array(
                'required' => 'required'
            )
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Collection',
            'name' => 'addresses',
            'options' => array(
                'label' => 'Please choose addresses for this client',
                'count' => 1,
                'should_create_template' => true,
                'allow_add' => true,
                'target_element' => array(
                    'type' => 'People\Form\Fieldset\Address'
                )
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
            'tax_id' => array(
                'required' => true,
            )
        );
    }
}