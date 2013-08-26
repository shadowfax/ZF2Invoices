<?php
namespace Invoices\Entity;

use Zend\InputFilter\InputFilterAwareInterface;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * An example of how to implement a role aware user entity.
 *
 * @ORM\Entity
 * @ORM\Table(name="products")
 *
 */
class Product
{
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
     * @ORM\Column(type="string", nullable=true)
     */
    protected $description;
    
    /**
     * @var float
     * @ORM\Column(type="decimal", precision=21, scale=2, nullable=false)
     */
    protected $unit_price;
    
    
    /**
     * @var \Doctrine\Common\Collections\Collection
     * @ORM\ManyToMany(targetEntity="Invoices\Entity\Tax")
     * @ORM\JoinTable(name="products_taxes",
     *      joinColumns={@ORM\JoinColumn(name="product_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="tax_id", referencedColumnName="id")}
     * )
     */
    protected $taxes;
    
    
    
    /**
     * @var string
     * @ORM\Column(type="string", length=20, nullable=false)
     */
    protected $item_type = 'product';
    
	/**
     * Initialies the taxes variable.
     */
    public function __construct()
    {
        $this->taxes = new ArrayCollection();
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
     * Get name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set name.
     *
     * @param string $name
     *
     * @return void
     */
    public function setName($name)
    {
        $this->name = $name;
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
     * Get unit price.
     *
     * @return float
     */
    public function getUnitPrice()
    {
        return $this->unit_price;
    }

    /**
     * Set unit price.
     *
     * @param string $price
     *
     * @return void
     */
    public function setUnitPrice($price)
    {
        $this->unit_price = $price;
    }

    
	/**
     * Get item type.
     *
     * @return string
     */
    public function getItemType()
    {
        return $this->item_type;
    }

    /**
     * Set item type.
     *
     * @param string $type
     *
     * @return void
     */
    public function setItemType($type)
    {
        $this->item_type = strtolower($type);
    }
    
	/**
     * Get tax.
     *
     * @return array
     */
    public function getTaxes()
    {
        //return $this->taxes->getValues();
        return $this->taxes;
    }
    
    public function setTaxes($taxes)
    {
    	$this->taxes = $taxes;
    }

    /**
     * Add a tax to the product.
     *
     * @param Tax $tax
     *
     * @return void
     */
    public function addTax($tax)
    {
        $this->taxes->add($tax);
    }
    
    /**
     * Check if it is a service
     * 
     * @return bool
     */
    public function isService()
    {
    	if (strcasecmp($this->item_type, 'service') === 0) {
    		return true;
    	}
    	return false;
    }
    
	/**
     * Check if it is a product
     * 
     * @return bool
     */
    public function isProduct()
    {
    	if (strcasecmp($this->item_type, 'product') === 0) {
    		return true;
    	}
    	return false;
    }
	
}