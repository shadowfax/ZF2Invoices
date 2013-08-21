<?php
namespace Invoices\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * An example of how to implement a role aware user entity.
 *
 * @ORM\Entity
 * @ORM\Table(name="contacts")
 * @ORM\MappedSuperClass
 *
 */
class Contact
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
     * @ORM\Column(type="string",  length=255)
     */
    protected $first_name;
    
    /**
     * @var string
     * @ORM\Column(type="string",  length=255)
     */
    protected $last_name;
    
    /**
     * @var string
     * @ORM\Column(type="string",  length=255)
     */
    protected $email;
    
    /**
     * @var string
     * @ORM\Column(type="string", length=15)
     */
    protected $phone;
    
    /**
     * @var string
     * @ORM\Column(type="string", length=15)
     */
    protected $mobile_phone;
    
    /**
     * @var string
     * @ORM\Column(type="string",  length=30)
     */
    protected $contact_type;
    
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
     * Get first name.
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->first_name;
    }

    /**
     * Set first name.
     *
     * @param string $name
     *
     * @return void
     */
    public function setFirstName($name)
    {
        $this->first_name = $name;
    }
    
	/**
     * Get last name.
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->last_name;
    }

    /**
     * Set last name.
     *
     * @param string $name
     *
     * @return void
     */
    public function setLastName($name)
    {
        $this->last_name = $name;
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
     * Get phone.
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set phone.
     *
     * @param string $phone
     *
     * @return void
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }
    
	/**
     * Get mobile phone.
     *
     * @return string
     */
    public function getMobilePhone()
    {
        return $this->mobile_phone;
    }

    /**
     * Set mobile phone.
     *
     * @param string $phone
     *
     * @return void
     */
    public function setMobilePhone($phone)
    {
        $this->mobile_phone = $phone;
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
} 