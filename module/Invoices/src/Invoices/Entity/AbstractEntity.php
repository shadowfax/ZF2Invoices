<?php
namespace Invoices\Entity;

use Zend\InputFilter\InputFilterInterface;

use Zend\InputFilter\InputFilterAwareInterface;

abstract class AbstractEntity implements InputFilterAwareInterface
{
	/**
	 * Input filter instance.
	 * NOTE: Underscore is used so the implicit setters/getters won't access it.
	 * 
	 * @var Zend\InputFilter\InputFilterInterface
	 */
	protected $_inputFilter;
	
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
     * Magic setter to see if a property is set.
     *
     * @param string $property
     * @param mixed $value
     */
    public function __isset($property)
    {
    	if (!property_exists($this, $property)) return false;
    	return isset($this->$property);
    }
    
	/**
     * Implicit getters and setters.
     * 
     * @param string $methodName
     * @param array $args
     */
    public function __call($methodName, $args) 
    {
    	if (preg_match('~^(set|get)([A-Z])(.*)$~', $methodName, $matches)) {
    		$property = strtolower($matches[2]) . $matches[3];
    		if (!property_exists($this, $property)) {
    			$property = preg_replace('/\B([A-Z])/', '_$1', $property);
    			$property = strtolower($property);
    			if (!property_exists($this, $property)) {
    				throw new \Exception('Property ' . $property . ' does not exist');
    			}
    		}
    		
    		$argc = count($args);
    		
    		switch($matches[1]) {
    			case 'set':
                    if ($argc !== 1) {
                    	throw new \Exception('Missing argument for for method ' . $methodName . '.');
                    }
                    $this->$property = $args[0];
                    return $this;
                case 'get':
                	if ($argc !== 0) {
                		throw new \Exception('Method ' . $methodName . ' does not require arguments.');
                	}
                    return $this->$property;
                case 'default':
                    throw new \Exception('Method ' . $methodName . ' does not exist');
    		}
    	}
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
    	foreach($data as $key => $value) {
    		// Avoid undescored values from being populated
    		if (property_exists($this, $key) && (preg_match('~^([a-z])(.*)$~', $key))) {
    			$this->$key = $value;
    		}
    	}
    }
    
    /**
     * Set input filter
     *
     * @param  Zend\InputFilter\InputFilterInterface $inputFilter
     * @return InputFilterAwareInterface
     */
	public function setInputFilter(InputFilterInterface $inputFilter)
    {
        throw new \Exception("setInputFilter is not available for entities");
    }
    
    /**
     * Retrieve input filter
     *
     * @return Zend\InputFilter\InputFilterInterface
     */
    abstract public function getInputFilter();
}