<?php
namespace Invoices\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * An example of how to implement a role aware user entity.
 *
 * @ORM\Entity
 * @ORM\Table(name="taxes")
 *
 */
class Tax
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
    protected $active;
    
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