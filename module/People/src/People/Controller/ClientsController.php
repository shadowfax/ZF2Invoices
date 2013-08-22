<?php
namespace People\Controller;


use Invoices\Service\ClientService;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Invoices\Entity\Customer;
use People\Form\Customer as CustomerForm;
// Paginator
use Zend\Paginator\Paginator;
use Doctrine\ORM\Tools\Pagination\Paginator as ORMPaginator;
use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator;



class ClientsController extends AbstractActionController
{
	
    /**
     * 
     * Enter description here ...
     * @var ClientService
     */
    protected $clientService;
    
    /**
     * 
     * @return ClientService
     */
    public function getClientService()
    {
    	if (null === $this->clientService) {
    		$this->clientService = $this->getServiceLocator()->get('invoices.service.client');
    	}
    	return $this->clientService;
    }
    
    
    public function indexAction()
    {
    	// Pagination
    	$view = new ViewModel();
    	
    	$entityManager = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
		$repository = $entityManager->getRepository('Invoices\Entity\Customer');
		$adapter = new DoctrinePaginator(new ORMPaginator($repository->createQueryBuilder('customer')));
		$paginator = new Paginator($adapter);
		
		// Dynamic results per page
		$results = (int)$this->params()->fromQuery('results');
		if ($results < 10) $results = 20;
		$paginator->setDefaultItemCountPerPage($results);
		
		$page = (int)$this->params()->fromQuery('page');
		if($page) $paginator->setCurrentPageNumber($page);
		
		$view->setVariable('paginator',$paginator);
		
		return new ViewModel(array(
			'paginator' => $paginator,
		));
    	// TODO: Use paginator
        //return new ViewModel(
        //	array(
        //		'customers' => $this->getClientService()->findAll()
        //	)
        //);
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
    	
        $customer = $this->getClientService()->find($id);
        
    	// TODO: sanity checks
    	
    	$form = new CustomerForm($this->getClientService()->getEntityManager());
		$form->bind($customer);

		if ($this->request->isPost()) {
			$form->setData($this->request->getPost());

			if ($form->isValid()) {
				$this->getClientService()->persist($customer);
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
    	$form = new CustomerForm($this->getclientService()->getEntityManager());
		$customer = new Customer();
		$form->bind($customer);

		if ($this->request->isPost()) {
			$form->setData($this->request->getPost());

			if ($form->isValid()) {
				$this->getClientService()->persist($customer);
				return $this->redirect()->toRoute('people/default', array('controller' => 'clients'));
			}
		}

		return array(
			'form' => $form
		);
    }
    
}
