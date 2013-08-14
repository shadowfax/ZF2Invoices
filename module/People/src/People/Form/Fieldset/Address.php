<?php
namespace People\Form\Fieldset;

use Invoices\Entity\Address as AddressEntity;
use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Stdlib\Hydrator\ClassMethods as ClassMethodsHydrator;

class Address extends Fieldset implements InputFilterProviderInterface
{
    public function __construct()
    {
        parent::__construct('address');
        $this->setHydrator(new ClassMethodsHydrator(false))
             ->setObject(new AddressEntity());

        $this->setLabel('Address');

        $this->add(array(
            'name' => 'name',
            'options' => array(
                'label' => 'Name of the address'
            ),
            'attributes' => array(
                'required' => 'required'
            )
        ));
    }

    /**
     * @return array
     \*/
    public function getInputFilterSpecification()
    {
        return array(
            'name' => array(
                'required' => true,
            )
        );
    }
}