<?php
namespace Invoices\Controller;

use Invoices\Entity\Product as ProductEntity;
use Invoices\Form\Product as ProductForm;


use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class ItemsController extends AbstractActionController
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
    
    public function getItemTypesForCombobox()
    {
    	$resultset = array();
    	
    	$query = $this->getEntityManager()->createQuery('SELECT DISTINCT p.item_type FROM Invoices\Entity\Product p');
		$item_types = $query->getResult();
		foreach($item_types as $item_type) {
			$resultset[strtolower($item_type['item_type'])] = ucfirst($item_type['item_type']);
		}
		return $resultset;
    }
    
    public function indexAction()
    {
        // TODO: Use paginator
        return new ViewModel(
        	array(
        		'products' => $this->getEntityManager()->getRepository('Invoices\Entity\Product')->findAll()
        	)
        );
    }
    
	public function addAction()
    {
        $form = new ProductForm( $this->getEntityManager() );
		$product = new ProductEntity();
		$form->bind($product);
	
		$form->get('itemType')->setValueOptions($this->getItemTypesForCombobox());

		if ($this->request->isPost()) {
			$form->setData($this->request->getPost());

			if ($form->isValid()) {
				$unit_cost = $product->getUnitCost(); 
				if (empty($unit_cost)) {
					$product->setUnitCost(0.0);
				}
				
				$this->getEntityManager()->persist($product);
				$this->getEntityManager()->flush($product);
				return $this->redirect()->toRoute('invoices/default', array('controller' => 'items'));
			}
		}

		return array(
			'form' => $form
		);
    }
    
	public function editAction()
    {
    	$id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('invoices/default', array(
            	'controller' => 'items',
                'action'     => 'add'
            ));
        }
    	
        $product = $this->getEntityManager()->getRepository('Invoices\Entity\Product')->findOneBy(array('id' => $id));
        
        $form = new ProductForm( $this->getEntityManager() );
		$form->bind($product);
	
		$form->get('itemType')->setValueOptions($this->getItemTypesForCombobox());
		
		if ($this->request->isPost()) {
			$form->setData($this->request->getPost());

			//var_dump($product->getTaxes());die();
			if ($form->isValid()) {
				$unit_cost = $product->getUnitCost(); 
				if (empty($unit_cost)) {
					$product->setUnitCost(0.0);
				}
				
				$this->getEntityManager()->persist($product);
				$this->getEntityManager()->flush($product);
				return $this->redirect()->toRoute('invoices/default', array('controller' => 'items'));
			}
		}

		return array(
			'form' => $form,
			'item' => $product
		);
    }
}
