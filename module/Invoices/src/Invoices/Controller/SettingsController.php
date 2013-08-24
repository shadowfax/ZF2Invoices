<?php
namespace Invoices\Controller;

use Doctrine\Common\Collections\ArrayCollection;

use Invoices\Form\TaxSettings as TaxSettingsForm;

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
    	$form = new TaxSettingsForm($this->getEntityManager());
    	
    	if ($this->request->isPost()) {
			$form->setData($this->request->getPost());

			if ($form->isValid()) {
				foreach ($this->request->getPost('taxes') as $tax) {
					$taxEntity = $this->getEntityManager()->getRepository('Invoices\Entity\Tax')->findOneBy(array('id' => $tax['id']));
					if (empty($taxEntity)) $taxEntity = new TaxEntity();
					$taxEntity->populate($tax);
					$this->getEntityManager()->persist($taxEntity);
					$this->getEntityManager()->flush($taxEntity);
				}
				return $this->redirect()->toRoute('settings/default', array('action' => 'taxes'));	
			}
		}
    	
    	return new ViewModel(array(
    		'form' => $form
    	));
    	/*
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
        */
    }
}
