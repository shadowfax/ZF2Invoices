<?php
namespace Invoices\Entity;


use Doctrine\ORM\Mapping as ORM;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;
use Zend\InputFilter\Factory as InputFilterFactory;
use Zend\InputFilter\InputFilter;

/**
 * An example of how to implement a role aware user entity.
 *
 * @ORM\Entity
 * @ORM\Table(name="currencies")
 *
 */
class Currency implements InputFilterAwareInterface
{
	/**
	 * Input filter instance.
	 * 
	 * @var InputFilterInterface
	 */
	protected $inputFilter;
	
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
     * Magic getter to expose protected properties.
     *
     * @param string $property
     * @return mixed
     */
    public function __get($property) 
    {
    	if (property_exists($this, $property)) return $this->$property;
    	return null;
    }

    /**
     * Magic setter to save protected properties.
     *
     * @param string $property
     * @param mixed $value
     */
    public function __set($property, $value) 
    {
        if (property_exists($this, $property)) {
			$this->$property = $value;
        } else {
        	throw new \Exception('Property "' . $property .'" does not exist.');
        }
    }
    
    /**
     * Set input filter
     *
     * @param  InputFilterInterface $inputFilter
     * @return InputFilterAwareInterface
     */
	public function setInputFilter(InputFilterInterface $inputFilter)
    {
        throw new \Exception("Not used");
    }
    
    /**
     * Retrieve input filter
     *
     * @return InputFilterInterface
     */
    public function getInputFilter()
    {
    	if (null === $this->inputFilter) {
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
    		
    		$this->inputFilter = $inputFilter;
    	}
    	
    	return $this->inputFilter;
    }
    
	/**
     * Convert the object to an array.
     *
     * @return array
     */
    public function getArrayCopy() 
    {
        return get_object_vars($this);
    }

    /**
     * Populate from an array.
     *
     * @param array $data
     */
    public function populate($data = array()) 
    {
        $this->iso      = $data['iso'];
        $this->currency = $data['currency'];
        $this->symbol   = $data['symbol'];
    }
    
    
    public function getCurrency()
    {
    	return $this->currency;
    }
    
    public function setCurrency($currency)
    {
    	$this->currency = $currency;
    }
	 
    public function getIso()
    {
    	return $this->iso;
    }
    
    public function setIso($iso)
    {
    	$this->iso = $iso;
    }
    
    public function getSymbol()
    {
    	return $this->symbol;
    }
    
    public function setSymbol($symbol)
    {
    	$this->symbol = $symbol;
    }
}