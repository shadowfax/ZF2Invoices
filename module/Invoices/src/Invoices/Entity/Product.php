<?php
namespace Invoices\Entity;

use Doctrine\ORM\Mapping as ORM;

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
     * @var float
     * @ORM\Column(type="decimal", precision=21, scale=2, nullable=true)
     */
    protected $unit_cost;
    
    /**
     * @ORM\OneToOne(targetEntity="Invoices\Entity\Tax")
     * @ORM\JoinColumn(name="tax_id", referencedColumnName="id")
     */
    protected $tax;
    
    /**
     * @ORM\OneToOne(targetEntity="Invoices\Entity\Tax")
     * @ORM\JoinColumn(name="additional_tax_id", referencedColumnName="id", nullable=true)
     */
    protected $additional_tax;
    
    /**
     * @var string
     * @ORM\Column(type="string", length=20, nullable=false)
     */
    protected $item_type = 'product';
    
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
     * Get unit cost.
     *
     * @return float
     */
    public function getUnitCost()
    {
        return $this->unit_cost;
    }

    /**
     * Set unit cost.
     *
     * @param string $price
     *
     * @return void
     */
    public function setUnitCost($price)
    {
        $this->unit_cost = $price;
    }

    public function getTax()
    {
    	return $this->tax;
    }
    
    public function setTax($tax)
    {
    	$this->tax = $tax;
    }
    
	public function getAdditionalTax()
    {
    	return $this->additional_tax;
    }
    
    public function setAdditionalTax($tax)
    {
    	$this->additional_tax = $tax;
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