<?php
namespace People\Controller;

use Invoices\Service\ClientService;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Invoices\Entity\Customer;
use People\Form\Customer as CustomerForm;

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
    	// TODO: Use paginator
        return new ViewModel(
        	array(
        		'customers' => $this->getClientService()->findAll()
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
