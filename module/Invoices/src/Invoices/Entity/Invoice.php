<?php
namespace Invoices\Entity;


use Doctrine\ORM\Mapping as ORM;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;
use Zend\InputFilter\Factory as InputFilterFactory;
use Zend\InputFilter\InputFilter;


class Invoice
{
	/**
     * @var string
     * @ORM\Id
     * @ORM\Column(type="integer")
     */
	protected $company_id;
	
	/**
     * @var string
     * @ORM\Id
     * @ORM\Column(type="string", length=4, unique=false, nullable=false)
     */
	protected $serie;
	
	/**
     * @var int
     * @ORM\Id
     * @ORM\Column(type="integer")
     */
    protected $number;
    
    /**
     * @ORM\Column(type="date")
     */
    protected $date;
    
    /**
     * @ORM\OneToOne(targetEntity="Currency")
     * @ORM\JoinColumn(name="base_currency", referencedColumnName="iso")
     */
    protected $currency;
    
    /**
     * @var string
     * @ORM\Column(type="string", length=30)
     * 
     * Example: open, closed, draft
     */
    protected $status;
    
    
    
    
    protected $status;

}