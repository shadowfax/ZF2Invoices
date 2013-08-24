<?php
namespace Invoices\Form\Fieldset;

use Doctrine\Common\Persistence\ObjectManager;

use DoctrineModule\Persistence\ObjectManagerAwareInterface;

use Invoices\Entity\Tax as TaxEntity;

use Zend\InputFilter\InputFilterProviderInterface;

use Zend\Form\Fieldset;

use Zend\Stdlib\Hydrator\ClassMethods as ClassMethodsHydrator;

class TaxesFieldset extends Fieldset implements ObjectManagerAwareInterface, InputFilterProviderInterface
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
    	
		parent::__construct('tax');
        $this->setHydrator(new ClassMethodsHydrator(false))
             ->setObject(new TaxEntity());
        
        // http://samminds.com/2013/03/zendformelementselect-and-database-values/
        $this->add(array(
	        'type'    => 'DoctrineModule\Form\Element\ObjectSelect',
	        //'type'    => 'DoctrineORMModule\Form\Element\EntitySelect',
	        'name'    => 'id',
	        'options' => array(
	            'label'          => 'Tax',
	            'object_manager' => $this->getObjectManager(),
	            'target_class'   => 'Invoices\Entity\Tax',
	            'property'       => 'description',
	            'empty_option'   => '[Choose One]',
        		'required'       => 'required'
	        ),
	        'attributes' => array(
	        	'class' => 'input-large',
	        )
	    ));
    }

    /**
     * @return array
     \*/
    public function getInputFilterSpecification()
    {
        return array(
        );
    }
}