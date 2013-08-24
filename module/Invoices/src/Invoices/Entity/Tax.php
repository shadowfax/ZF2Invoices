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
 * @ORM\Table(name="taxes")
 *
 */
class Tax implements InputFilterAwareInterface
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
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id = 0;
    
    /**
     * @var string
     * @ORM\Column(type="string", length=50, unique=true, nullable=false)
     */
    protected $description;
    
    /**
     * @var float
     * @ORM\Column(type="decimal", precision=4, scale=1, nullable=false)
     */
    protected $percentage;
    
    /**
     * @var float
     * @ORM\Column(type="decimal", precision=4, scale=1, nullable=true)
     */
    protected $equalization;
    
    /**
     * @var bool
     * @ORM\Column(type="boolean")
     */
    protected $active = true;
    
    
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
    			'name'     => 'id',
    			'required' => 'true',
    			'filters'  => array(
    				array('name' => 'Int')
    			)
    		)));
    		
    		$inputFilter->add($factory->createInput(array(
    			'name'     => 'description',
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
    						'max'      => 50
    					)
    				)
    			)
    		)));
    		
    		$inputFilter->add($factory->createInput(array(
    			'name'     => 'percentage',
    			'required' => 'true',
    			'filters'  => array(
    				array('name' => 'Digits')
    			)
    		)));
    		
    		$inputFilter->add($factory->createInput(array(
    			'name'     => 'equalization',
    			'required' => 'false',
    			'filters'  => array(
    				array('name' => 'Digits')
    			)
    		)));
    		
    		$inputFilter->add($factory->createInput(array(
    			'name'     => 'active',
    			'required' => 'false',
    			'filters'  => array(
    				array('name' => 'Boolean')
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
        $this->id           = $data['id'];
        $this->description  = $data['description'];
        $this->percentage   = $data['percentage'];
        $this->equalization = $data['equalization'];
        $this->active       = $data['active'];
    }
    
	/**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set id.
     *
     * @param int $id
     *
     * @return void
     */
    public function setId($id)
    {
        $this->id = (int) $id;
    }
    
	/**
     * Get description.
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set description.
     *
     * @param string $description
     *
     * @return void
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }
    
	/**
     * Get percentage.
     *
     * @return float
     */
    public function getPercentage()
    {
        return $this->percentage;
    }

    /**
     * Set percentage.
     *
     * @param string $percentage
     *
     * @return void
     */
    public function setPercentage($percentage)
    {
        $this->percentage = $percentage;
    }
    
	/**
     * Get equalization.
     *
     * @return float
     */
    public function getEqualization()
    {
        return $this->equalization;
    }

    /**
     * Set equalization.
     *
     * @param string $percentage
     *
     * @return void
     */
    public function setEqualization($percentage)
    {
        $this->equalization = $percentage;
    }
    
	/**
     * Get active.
     *
     * @return bool
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Set Active.
     *
     * @param bool $active
     *
     * @return void
     */
    public function setActive($active)
    {
        $this->active = $active;
    }
   
}