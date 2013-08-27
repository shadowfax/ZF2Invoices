<?php
namespace Invoices\Entity;


use Doctrine\ORM\Mapping as ORM;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;
use Zend\InputFilter\Factory as InputFilterFactory;
use Zend\InputFilter\InputFilter;

/**
 * @ORM\Entity
 * @ORM\Table(name="countries")
 */
class Country implements InputFilterAwareInterface
{
	/**
     * @var string
     * @ORM\Id
     * @ORM\Column(type="string", length=2, nullable=false)
     */
    protected $iso;
    
    /**
     * @var string
     * @ORM\Column(type="string", length=80, unique=true, nullable=false)
     */
    protected $english_name;
    
    /**
     * @var string
     * @ORM\Column(type="string", length=3, nullable=true)
     */
    protected $iso3;
    
    /**
     * @var string
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $numcode;
    
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
    						'max'      => 2
    					)
    				)
    			)
    		)));
    		
    		$inputFilter->add($factory->createInput(array(
    			'name'     => 'english_name',
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
    						'max'      => 80
    					)
    				)
    			)
    		)));
    		
    		$inputFilter->add($factory->createInput(array(
    			'name'     => 'iso3',
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
            	'name'     => 'numcode',
            	'required' => true,
            	'filters'  => array(
                	array('name' => 'Int'),
            	),
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
        $this->iso          = $data['iso'];
        $this->english_name = $data['english_name'];
        $this->iso3         = $data['iso3'];
        $this->numcode      = $data['numcode'];
    }
    
	/**
     * Get iso code 2.
     *
     * @return string
     */
    public function getIso()
    {
        return $this->iso;
    }

    /**
     * Set iso code 2.
     *
     * @param string $code
     *
     * @return void
     */
    public function setIso($code)
    {
        $this->iso = $code;
    }
    
	/**
     * Get english name.
     *
     * @return string
     */
    public function getEnglishName()
    {
        return $this->english_name;
    }
    
    public function getEnglish_name()
    {
    	return $this->english_name;
    }

    /**
     * Set english name.
     *
     * @param string $name
     *
     * @return void
     */
    public function setEnglishName($name)
    {
        $this->english_name = $name;
    }
    
	/**
     * Get iso code 3.
     *
     * @return string
     */
    public function getIso3()
    {
        return $this->iso3;
    }

    /**
     * Set iso code 3.
     *
     * @param string $code
     *
     * @return void
     */
    public function setIso3($code)
    {
        $this->iso3 = $code;
    }
    
	/**
     * Get numeric code.
     *
     * @return int
     */
    public function getNumericCode()
    {
        return $this->numcode;
    }

    /**
     * Set numeric code.
     *
     * @param int $code
     *
     * @return void
     */
    public function setNumericCode($code)
    {
        $this->numcode = (int) $code;
    }
}