<?php
namespace Invoices\Entity;

use Invoices\Entity\Address;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * An example of how to implement a role aware user entity.
 *
 * @ORM\Entity
 * @ORM\Table(name="clients")
 * @ORM\MappedSuperClass
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
     * @ORM\Column(type="string", length=255, unique=true, nullable=false)
     */
    protected $name;

    /**
     * @var string
     * @ORM\Column(type="string", unique=true,  length=20)
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
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    protected $zip;
    
    
    /**
     * @ORM\OneToOne(targetEntity="Country")
     * @ORM\JoinColumn(name="country_iso", referencedColumnName="iso")
     */
    protected $country;

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
     * Get street.
     *
     * @return string
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * Set street.
     *
     * @param string $street
     *
     * @return void
     */
    public function setStreet($street)
    {
        $this->street = $street;
    }
    
	/**
     * Get street 2.
     *
     * @return string
     */
    public function getStreet2()
    {
        return $this->street2;
    }

    /**
     * Set street 2.
     *
     * @param string $street
     *
     * @return void
     */
    public function setStreet2($street)
    {
        $this->street2 = $street;
    }
    
	/**
     * Get locality.
     *
     * @return string
     */
    public function getLocality()
    {
        return $this->locality;
    }

    /**
     * Set locality.
     *
     * @param string $locality
     *
     * @return void
     */
    public function setLocality($locality)
    {
        $this->locality = $locality;
    }
    
	/**
     * Get region.
     *
     * @return string
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * Set region.
     *
     * @param string $region
     *
     * @return void
     */
    public function setRegion($region)
    {
        $this->region = $region;
    }

	/**
     * Get zip.
     *
     * @return string
     */
    public function getZip()
    {
        return $this->zip;
    }

    /**
     * Set zip.
     *
     * @param string $zip
     *
     * @return void
     */
    public function setZip($zip)
    {
        $this->zip = $zip;
    }
    
	/**
     * Get country.
     *
     * @return \Invoices\Entity\Country
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set country.
     *
     * @param \Invoices\Entity\Country $country
     *
     * @return void
     */
    public function setCountry($country)
    {
        $this->country = $country;
    }
    
}