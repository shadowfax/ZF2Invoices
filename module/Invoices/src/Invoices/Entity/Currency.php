<?php
namespace Invoices\Entity;


use Doctrine\ORM\Mapping as ORM;
use Zend\InputFilter\Factory as InputFilterFactory;
use Zend\InputFilter\InputFilter;

/**
 * An example of how to implement a role aware user entity.
 *
 * @ORM\Entity
 * @ORM\Table(name="currencies")
 *
 */
class Currency extends AbstractEntity
{
	
	/**
     * @var int
     * @ORM\Id
     * @ORM\Column(type="string", length=10)
     */
    protected $iso;
    
    /**
     * @var string
     * @ORM\Column(type="string", length=255, unique=false, nullable=false)
     */
    protected $currency;
    
    /**
     * @var string
     * @ORM\Column(type="string", length=10, unique=false, nullable=true)
     */
    protected $symbol;
    
    
	
    
    /**
     * Retrieve input filter
     *
     * @return InputFilterInterface
     */
    public function getInputFilter()
    {
    	if (null === $this->_inputFilter) {
    		$inputFilter = new InputFilter();
    		$factory     = new InputFilterFactory();
    		
    		$inputFilter->add($factory->createInput(array(
    			'name'     => 'iso',
    			'required' => 'true',
    			'filters'  => array(
    				array('name' => 'StripTags'),
    				array('name' => 'StringTrim'),
    			),
    			'validators' => array(
    				array(
    					'name'    => 'StringLength',
    					'options' => array(
    						'encoding' => 'UTF-8',
    						'min'      => 1,
    						'max'      => 3
    					)
    				)
    			)
    		)));
    		
    		$inputFilter->add($factory->createInput(array(
    			'name'     => 'currency',
    			'required' => 'true',
    			'filters'  => array(
    				array('name' => 'StripTags'),
    				array('name' => 'StringTrim'),
    			),
    			'validators' => array(
    				array(
    					'name'    => 'StringLength',
    					'options' => array(
    						'encoding' => 'UTF-8',
    						'min'      => 1,
    						'max'      => 255
    					)
    				)
    			)
    		)));
    		
    		$inputFilter->add($factory->createInput(array(
    			'name'     => 'symbol',
    			'required' => 'true',
    			'filters'  => array(
    				array('name' => 'StripTags'),
    				array('name' => 'StringTrim'),
    			),
    			'validators' => array(
    				array(
    					'name'    => 'StringLength',
    					'options' => array(
    						'encoding' => 'UTF-8',
    						'min'      => 1,
    						'max'      => 10
    					)
    				)
    			)
    		)));
    		
    		$this->_inputFilter = $inputFilter;
    	}
    	
    	return $this->_inputFilter;
    }
    
	
}