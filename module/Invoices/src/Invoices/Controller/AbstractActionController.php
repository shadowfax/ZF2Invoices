<?php
namespace Invoices\Controller;

use Zend\Mvc\Controller\AbstractActionController as ZFAbstractActionController;
use Doctrine\ORM\EntityManager;

abstract class AbstractActionController extends ZFAbstractActionController
{
	/**   
     * Entity manager instance
     *           
     * @var Doctrine\ORM\EntityManager
     */                
    protected $entityManager;
    
    /**
     * Company instance.
     * 
     * @var Invoices\Entity\Company
     */
    protected $company;
    
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
    
    /**
     * Returns as instance of the company for the current user.
     * 
     * @return Invoices\Entity\Company
     */
	public function getCompany()
    {
    	if (null === $this->company) {
    		$auth = $this->getServiceLocator()->get('zfcuserauthservice');
    		if (!$auth->hasIdentity()) {
    			return $this->redirect()->toRoute('zfcuser/login');
    		}
    		$this->company = $auth->getIdentity()->getCompany();
    	}
    	return $this->company;
    }
    
    
}