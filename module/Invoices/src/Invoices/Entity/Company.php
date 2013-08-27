<?php
namespace Invoices\Entity;


use Doctrine\ORM\Mapping as ORM;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;
use Zend\InputFilter\Factory as InputFilterFactory;
use Zend\InputFilter\InputFilter;


/**
 * 
 * @ORM\Entity
 * @ORM\Table(name="companies")
 *
 */
class Company implements InputFilterAwareInterface
{
	
	/**
	 * Input filter instance.
	 * @var Zend\InputFilter\InputFilterInterface
	 */
	protected $inputFilter;
	
	/**
     * @var int
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    protected $name;
    
    /**
     * @var string
     * @ORM\Column(type="string", length=15, unique=false, nullable=true)
     */
    protected $tax_id;
    
    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    protected $street;
    
    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $street2;
    
    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    protected $locality;
    
    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    protected $region;
    
    /**
     * @var string
     * @ORM\Column(type="string", length=20, nullable=false)
     */
    protected $zip;
    
    
    /**
     * @ORM\OneToOne(targetEntity="Country")
     * @ORM\JoinColumn(name="country_iso", referencedColumnName="iso")
     */
    protected $country;
    
    /**
     * @var string
     * @ORM\Column(type="string", length=30, nullable=true)
     */
    protected $phone;
    
    /**
     * @var string
     * @ORM\Column(type="string", length=30, nullable=true)
     */
    protected $fax;
    
    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $email;
    
    /**
     * @ORM\OneToOne(targetEntity="Currency")
     * @ORM\JoinColumn(name="base_currency", referencedColumnName="iso")
     */
    protected $currency;
    
    
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
    		
    		/*
    		$inputFilter->add($factory->createInput(array(
    			'name'     => 'id',
    			'required' => 'true',
    			'filters'  => array(
    				array('name' => 'Int')
    			)
    		)));
    		*/
    		$inputFilter->add($factory->createInput(array(
    			'name'     => 'name',
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
    			'name'        => 'tax_id',
    			'required'    => 'false',
    			'allow_empty' => 'true',
    			'filters'  => array(
    				array('name' => 'StripTags'),
    				array('name' => 'StringTrim'),
    			),
    			'validators' => array(
    				array(
    					'name'    => 'StringLength',
    					'options' => array(
    						'encoding' => 'UTF-8',
    						'min'      => 0,
    						'max'      => 15
    					)
    				)
    			)
    		)));
    		
    		$inputFilter->add($factory->createInput(array(
    			'name'     => 'street',
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
    			'name'        => 'street2',
    			'required'    => 'false',
    			'allow_empty' => 'true',
    			'filters'     => array(
    				array('name' => 'StripTags'),
    				array('name' => 'StringTrim'),
    			),
    			'validators' => array(
    				array(
    					'name'    => 'StringLength',
    					'options' => array(
    						'encoding' => 'UTF-8',
    						'min'      => 0,
    						'max'      => 255
    					)
    				)
    			)
    		)));
    		
    		$inputFilter->add($factory->createInput(array(
    			'name'     => 'locality',
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
    			'name'     => 'region',
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
    			'name'     => 'zip',
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
    						'max'      => 20
    					)
    				)
    			)
    		)));
    		
    		$inputFilter->add($factory->createInput(array(
    			'name'        => 'phone',
    			'required'    => 'false',
    			'allow_empty' => 'true',
    			'filters'     => array(
    				array('name' => 'StripTags'),
    				array('name' => 'StringTrim'),
    			),
    			'validators' => array(
    				array(
    					'name'    => 'StringLength',
    					'options' => array(
    						'encoding' => 'UTF-8',
    						'min'      => 0,
    						'max'      => 30
    					)
    				)
    			)
    		)));
    		
    		$inputFilter->add($factory->createInput(array(
    			'name'        => 'fax',
    			'required'    => 'false',
    			'allow_empty' => 'true',
    			'filters'     => array(
    				array('name' => 'StripTags'),
    				array('name' => 'StringTrim'),
    			),
    			'validators' => array(
    				array(
    					'name'    => 'StringLength',
    					'options' => array(
    						'encoding' => 'UTF-8',
    						'min'      => 0,
    						'max'      => 30
    					)
    				)
    			)
    		)));
    		
    		$inputFilter->add($factory->createInput(array(
    			'name'     => 'email',
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
    				),
    				array(
    					'name' => 'EmailAddress',
    				)
    			)
    		)));
    		
    		$this->inputFilter = $inputFilter;
    	}
    	
    	return $this->inputFilter;
    }
    
    
    public function getName()
    {
    	return $this->name;
    }
    
    public function setName($name)
    {
    	$this->name = $name;
    }
    
    public function getTaxId()
    {
    	return $this->tax_id;
    }
    
	public function setTaxId($taxId)
    {
    	$this->tax_id = $taxId;
    }
    
    public function getCountry()
    {
    	return $this->country->getIso();
    }
    
    public function setCountry($country)
    {
    	$this->country = $country;
    }
    
    public function getStreet()
    {
    	return $this->street;
    }
    
    public function setStreet($street)
    {
    	$this->street = $street;
    }
    
    public function getStreet2()
    {
    	return $this->street2;
    }
    
	public function setStreet2($street)
    {
    	$this->street2 = $street;
    }
    
    public function getLocality()
    {
    	return $this->locality;
    }
    
	public function setLocality($locality)
    {
    	$this->locality = $locality;
    }
    
    public function getRegion()
    {
    	return $this->region;
    }
    
	public function setRegion($region)
    {
    	$this->region = $region;
    }
    
    public function getZip()
    {
    	return $this->zip;
    }
    
	public function setZip($zip)
    {
    	$this->zip = $zip;
    }
    
    public function getPhone()
    {
    	return $this->phone;
    }
    
	public function setPhone($phone)
    {
    	$this->phone = $phone;
    }
    
    public function getFax()
    {
    	return $this->fax;
    }
    
	public function setFax($fax)
    {
    	$this->fax = $fax;
    }
    
    
    public function getEmail()
    {
    	return $this->email;
    }
    
	public function setEmail($email)
    {
    	$this->email = $email;
    }
    
    public function getCurrency()
    {
    	return $this->currency->iso;
    }
    
	public function setCurrency($currency)
    {
    	$this->currency = $currency;
    }
}