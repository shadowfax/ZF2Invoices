<?php
namespace Invoices\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Invoices\Entity\Customer;

/**
 * An example of how to implement a role aware user entity.
 *
 * @ORM\Entity
 * @ORM\Table(name="addressbook")
 *
 */
class Address
{
	/**
     * @var int
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @ORM\ManyToOne(targetEntity="Invoices\Entity\Customer", inversedBy="addresses")
     * @ORM\JoinColumn(name="customer_id", referencedColumnName="id")
     * 
     */
    protected $customer_id;
    
    /**
     * @var string
     * @ORM\Column(type="string", unique=true,  length=255)
     */
    protected $name;
    
    /**
     * @var string
     * @ORM\Column(type="string",  length=255)
     */
    protected $url;
    
    /**
     * @var string
     * @ORM\Column(type="string",  length=30)
     */
    protected $contact_type;
    
    /**
     * @var string
     * @ORM\Column(type="string",  length=255)
     */
    protected $email;
    
    /**
     * @var string
     * @ORM\Column(type="string",  length=15)
     */
    protected $fax;
    
    /**
     * @var string
     * @ORM\Column(type="string", length=15)
     */
    protected $telephone;
    
    /**
     * @var string
     * @ORM\Column(type="string", length=3)
     */
    protected $country;
    
    /**
     * @var string
     * @ORM\Column(type="string", length=100)
     */
    protected $locality;
    
    /**
     * @var string
     * @ORM\Column(type="string", length=100)
     */
    protected $region;
    
    /**
     * @var string
     * @ORM\Column(type="string", length=30)
     */
    protected $postalcode;
    
    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    protected $street;
    
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
     * Get customer id.
     *
     * @return int
     */
    public function getCustomerId()
    {
        return $this->customer_id;
    }

    /**
     * Set customer id.
     *
     * @param int $id
     *
     * @return void
     */
    public function setCustomerId($id)
    {
        $this->customer_id = (int) $id;
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
     * Get url.
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set url.
     *
     * @param string $url
     *
     * @return void
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }
    
	/**
     * Get contact type.
     *
     * @return string
     */
    public function getContactType()
    {
        return $this->contact_type;
    }

    /**
     * Set contact type.
     *
     * @param string $contactType
     *
     * @return void
     */
    public function setContactType($contactType)
    {
        $this->contact_type = $contactType;
    }
    
	/**
     * Get email.
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set email.
     *
     * @param string $email
     *
     * @return void
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }
    
	/**
     * Get fax.
     *
     * @return string
     */
    public function getFax()
    {
        return $this->fax;
    }

    /**
     * Set fax.
     *
     * @param string $fax
     *
     * @return void
     */
    public function setFax($fax)
    {
        $this->fax = $fax;
    }
    
	/**
     * Get telephone.
     *
     * @return string
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * Set telephone.
     *
     * @param string $telephone
     *
     * @return void
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;
    }
    
	/**
     * Get country.
     *
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set country.
     *
     * @param string $countryCode
     *
     * @return void
     */
    public function setCountry($country)
    {
        $this->country = $country;
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
     * Get postal code.
     *
     * @return string
     */
    public function getPostalCode()
    {
        return $this->postalcode;
    }

    /**
     * Set postal code.
     *
     * @param string $postalcode
     *
     * @return void
     */
    public function setPostalCode($postalcode)
    {
        $this->postalcode = $postalcode;
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
}