<?php
namespace Invoices\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use Doctrine\ORM\EntityManager;
use Invoices\Entity\Tax as TaxEntity;

class SettingsController extends AbstractActionController
{
	/**   
     * Entity manager instance
     *           
     * @var Doctrine\ORM\EntityManager
     */                
    protected $entityManager;
    
	/**
     * Returns an instance of the Doctrine entity manager loaded from the service 
     * locator
     * 
     * @return Doctrine\ORM\EntityManager
     */
    public function getEntityManager()
    {
        if (null === $this->entityManager) {
            $this->entityManager = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        }
        return $this->entityManager;
    }
    
    public function companyAction()
    {
        return new ViewModel();
    }
    
	public function taxesAction()
    {
        // Is tax equalization active?
    	// Tax equalization in spanish is "Recargo de equivalencia" and is needed
    	// for some invoices
    	$tax_equalization = $this->getEntityManager()->getRepository('Application\Entity\Option')->findOneBy(array('key' => 'tax_equalization'));
    	if (null !== $tax_equalization) {
    		$tax_equalization = $tax_equalization->getValue();
    	}
    	
        return new ViewModel(
        	array(
        		'tax_equalization' => $tax_equalization,
                'taxes' => $this->getEntityManager()->getRepository('Invoices\Entity\Tax')->findAll() 
            )
        );
    }
}
