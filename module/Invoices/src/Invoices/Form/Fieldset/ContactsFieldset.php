<?php
namespace Invoices\Form\Fieldset;

use Zend\Form\Fieldset;
use Zend\Stdlib\Hydrator\ClassMethods as ClassMethodsHydrator;
use Invoices\Entity\Contact as ContactEntity;

class ContactsFieldset extends Fieldset
{
	
	public function __construct()
	{
		parent::__construct('contact');
        $this->setHydrator(new ClassMethodsHydrator(false))
            ->setObject(new ContactEntity());
	
        $this->add(array(
            'name' => 'email',
        	'options' => array(
                'label' => 'Email'
            ),
            'attributes' => array(
        		'class'    => 'input-large',
            )
        ));
        
        $this->add(array(
            'name' => 'firstName',
        	'options' => array(
                'label' => 'First name'
            ),
            'attributes' => array(
        		'class'    => 'input-small',
            )
        ));
        
        $this->add(array(
            'name' => 'lastName',
        	'options' => array(
                'label' => 'Last name'
            ),
            'attributes' => array(
        		'class'    => 'input-small',
            )
        ));
        
        
        $this->add(array(
            'name' => 'phone',
        	'options' => array(
                'label' => 'Phone'
            ),
            'attributes' => array(
        		'class'    => 'input-medium',
            )
        ));
        
        $this->add(array(
            'name' => 'mobilePhone',
        	'options' => array(
                'label' => 'Mobile'
            ),
            'attributes' => array(
        		'class'    => 'input-medium',
            )
        ));
	}

}