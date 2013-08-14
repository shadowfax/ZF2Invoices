<?php
namespace Invoices\Entity;

use Invoices\Entity\Address;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * An example of how to implement a role aware user entity.
 *
 * @ORM\Entity
 * @ORM\Table(name="customers")
 *
 */
class Customer 
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
     * @ORM\Column(type="string", length=255, unique=true, nullable=true)
     */
    protected $name;

    /**
     * @var string
     * @ORM\Column(type="string", unique=true,  length=20)
     */
    protected $tax_id;
    
    /**
     * @var \Doctrine\Common\Collections\Collection
     * @ORM\OneToMany(targetEntity="Invoices\Entity\Address", mappedBy="customer_id")
     */
    protected $addresses;

    /**
     * Initialies the addresses variable.
     */
    public function __construct()
    {
        $this->addresses = new ArrayCollection();
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
     * Get tax ID.
     *
     * @return string
     */
    public function getTaxId()
    {
        return $this->tax_id;
    }

    /**
     * Set tax ID.
     *
     * @param string $taxid
     *
     * @return void
     */
    public function setTaxId($taxid)
    {
        $this->tax_id = $taxid;
    }

    
    /**
     * Get addresses.
     *
     * @return array
     */
    public function getAddresses()
    {
        return $this->addresses->getValues();
    }

    /**
     * Add an address role to the customer.
     *
     * @param Address $role
     *
     * @return void
     */
    public function addAddress($address)
    {
        $this->addresses[] = $address;
    }
}