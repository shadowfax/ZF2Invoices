<?php
namespace Invoices\Form;


use Zend\InputFilter\InputFilterAwareInterface;

use Zend\Form\Form;
use Zend\Form\FormInterface;
use Zend\InputFilter\InputFilter;
use Zend\Stdlib\Hydrator\ClassMethods as ClassMethodsHydrator;
use DoctrineModule\Persistence\ObjectManagerAwareInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Invoices\Entity\Company as CompanyEntity;


class CompanySettings extends Form implements ObjectManagerAwareInterface
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
    	
        parent::__construct('company');

        $this->setAttribute('method', 'post')
             ->setAttribute('class', 'form-horizontal')
             ->setHydrator(new ClassMethodsHydrator(false))
             ->setInputFilter(new InputFilter())
             ->setObject(new CompanyEntity());
    
        //
        $this->add(array(
            'name' => 'name',
            'options' => array(
                'label' => 'Company Name',
        		'label_attributes' => array(
					'class'  => 'control-label'
				),
            ),
            'attributes' => array(
            	'class'    => 'input-xxlarge',
            	'id'       => 'company_name',
                'required' => 'required'
            )
        ));

        $this->add(array(
            'name' => 'taxId',
            'options' => array(
                'label' => 'Tax ID',
        		'label_attributes' => array(
					'class'  => 'control-label'
				),
            ),
            'attributes' => array(
            	'class'    => 'formTextMed'
            )
        ));
        
        // http://samminds.com/2013/03/zendformelementselect-and-database-values/
        $this->add(array(
	        'type'    => 'DoctrineModule\Form\Element\ObjectSelect',
	        'name'    => 'currency',
	        'options' => array(
	            'label'          => 'Base Currency',
        		'label_attributes' => array(
					'class'  => 'control-label'
				),
	            'object_manager' => $this->getObjectManager(),
	            'target_class'   => 'Invoices\Entity\Currency',
	            'property'       => 'currency',
	            'empty_option'   => '[Choose One]',
        		'required'       => 'required'
	        ),
	    ));
	    
        // http://samminds.com/2013/03/zendformelementselect-and-database-values/
        $this->add(array(
	        'type'    => 'DoctrineModule\Form\Element\ObjectSelect',
	        'name'    => 'country',
	        'options' => array(
	            'label'          => 'Country',
        		'label_attributes' => array(
					'class'  => 'control-label'
				),
	            'object_manager' => $this->getObjectManager(),
	            'target_class'   => 'Invoices\Entity\Country',
	            'property'       => 'english_name',
	            'empty_option'   => '[Choose One]',
        		'required'       => 'required'
	        ),
	    ));
        
        
        $this->add(array(
            'name' => 'street',
        	'options' => array(
                'label' => 'Address'
            ),
            'attributes' => array(
            	'class' => 'input-xxlarge',
                'required' => 'required'
            )
        ));
       
        
        $this->add(array(
            'name' => 'street2',
        	'attributes' => array(
        		'class' => 'input-xxlarge'
        	)
        ));

        $this->add(array(
            'name' => 'locality',
            'attributes' => array(
        		'class'    => 'input-medium',
                'required' => 'required'
            )
        ));
       
        $this->add(array(
            'name' => 'region',
            'attributes' => array(
        		'class'    => 'formTextMed',
                'required' => 'required'
            )
        ));
        
        $this->add(array(
            'name' => 'zip',
            'attributes' => array(
        		'class'    => 'input-mini',
                'required' => 'required'
            )
        ));
        
        $this->add(array(
            'name' => 'phone',
        	'options' => array(
                'label' => 'Business Phone',
        		'label_attributes' => array(
					'class'  => 'control-label'
				),
            ),
            'attributes' => array(
        		'class'    => 'input-medium',
            )
        ));
        
        $this->add(array(
            'name' => 'fax',
        	'options' => array(
                'label' => 'Fax',
        		'label_attributes' => array(
					'class'  => 'control-label'
				),
            ),
            'attributes' => array(
        		'class'    => 'input-medium',
            )
        ));
        
        $this->add(array(
            'name' => 'email',
        	'options' => array(
                'label' => 'E-Mail',
        		'label_attributes' => array(
					'class'  => 'control-label'
				),
            ),
            'attributes' => array(
        		'class'    => 'input-xxlarge',
            	'required' => 'required'
            )
        ));

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