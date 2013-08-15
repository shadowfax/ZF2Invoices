<?php
namespace Invoices\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="countries")
 */
class Country
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