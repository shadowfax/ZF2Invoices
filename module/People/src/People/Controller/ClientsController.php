<?php
namespace People\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Doctrine\ORM\EntityManager;
use Invoices\Entity\Customer;
use Invoices\Entity\Country;
use People\Form\Customer as CustomerForm;

class ClientsController extends AbstractActionController
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
    
    protected function getCountriesForCombobox()
    {
    	$resultset = array();
    	
    	$countries = $this->getEntityManager()->getRepository('Invoices\Entity\Country')->findAll();
    	foreach($countries as $country) {
    		$resultset[$country->getIso()] = $country->getEnglishName();
    	}
    	return $resultset;
    }
    
    public function indexAction()
    {
    	// TODO: Use paginator
        return new ViewModel(
        	array(
        		'customers' => $this->getEntityManager()->getRepository('Invoices\Entity\Customer')->findAll()
        	)
        );
    }
    
    // https://github.com/shanethehat/zf2-doctrine-tutorial/blob/master/module/Album/src/Album/Controller/AlbumController.php
    public function editAction()
    {
    	$id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('people/default', array(
            	'controller' => 'clients',
                'action'     => 'add'
            ));
        }
    	
        $customer = $this->getEntityManager()->getRepository('Invoices\Entity\Customer')->findOneBy(array('id' => $id));
        
    	// TODO: sanity checks
    	
    	$form = new CustomerForm($this->getEntityManager());
		$form->bind($customer);
		
		//$form->get('customer')->get('countryIso')->setValueOptions($this->getCountriesForCombobox());

		if ($this->request->isPost()) {
			$form->setData($this->request->getPost());

			if ($form->isValid()) {
				// Get the country
				$country = $this->getEntityManager()->getRepository('Invoices\Entity\Country')->findOneBy(array('iso' => $customer->getCountry()));
				$customer->setCountry( $country );
				
				$this->getEntityManager()->persist($customer);
				$this->getEntityManager()->flush($customer);
				return $this->redirect()->toRoute('people/default', array('controller' => 'clients'));
			}
		}

		return array(
			'form' => $form,
			'customer' => $customer
		);
    }
    
    public function addAction()
    {
    	$form = new CustomerForm($this->getEntityManager());
		$customer = new Customer();
		$form->bind($customer);

		if ($this->request->isPost()) {
			$form->setData($this->request->getPost());

			if ($form->isValid()) {
				// Get the country
				$country = $this->getEntityManager()->getRepository('Invoices\Entity\Country')->findOneBy(array('iso' => $customer->getCountry()));
				$customer->setCountry( $country );
				
				$this->getEntityManager()->persist($customer);
				$this->getEntityManager()->flush($customer);
				return $this->redirect()->toRoute('people/default', array('controller' => 'clients'));
			}
		}

		return array(
			'form' => $form
		);
    }
    
}
