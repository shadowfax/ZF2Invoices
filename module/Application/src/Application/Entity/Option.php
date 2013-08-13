<?php
namespace Application\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * An example of how to implement a role aware user entity.
 *
 * @ORM\Entity
 * @ORM\Table(name="options")
 *
 */
class Option
{
	/**
     * @var string
     * @ORM\Id
     * @ORM\Column(type="string", length=64)
     */
    protected $key;

    /**
     * @var string
     * @ORM\Column(type="text")
     */
    protected $value;

    
    /**
     * Get key.
     *
     * @return string
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * Set key.
     *
     * @param string $key
     *
     * @return void
     */
    public function setKey($key)
    {
        $this->key = (string) $key;
    }

    /**
     * Get value.
     *
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set value.
     *
     * @param string $value
     *
     * @return void
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    
}