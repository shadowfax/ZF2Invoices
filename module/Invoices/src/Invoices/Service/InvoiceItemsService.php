<?php
namespace Invoices\Service;

use Doctrine\Common\Collections\ArrayCollection;

class InvoiceItemsService extends AbstractDoctrineEntityService
{
	/**
	 * (non-PHPdoc)
	 * @see module/Invoices/src/Invoices/Service/Invoices\Service.AbstractDoctrineEntityService::getEntityRepository()
	 */
	public function getEntityRepository()
	{
		if (null === $this->entityRepository) {
            $this->setEntityRepository($this->getEntityManager()->getRepository('Invoices\Entity\Product'));
        }
        return $this->entityRepository;
	}
	
	/**
	 * Persist a Client
	 * 
	 * @param Invoices\Entity\Product $entity
	 * @throws \Exception
	 */
	public function persist($entity)
	{
		$connection = $this->getEntityManager()->getConnection();
		
		$connection->beginTransaction();
		$this->getEventManager()->trigger(__FUNCTION__ . '.pre', $this, array('entity'=>$entity));
		
		try {
			$taxes = $entity->getTaxes();
			$entity->setTaxes(new ArrayCollection());
	        $this->getEntityManager()->persist($entity);
	        $this->getEntityManager()->flush($entity);
	        // Save the taxes
	        $connection->executeUpdate('DELETE FROM products_taxes WHERE product_id = ?', array($entity->getId()));
	        foreach ($taxes as $tax) {
	        	$connection->executeUpdate('INSERT INTO products_taxes (product_id, tax_id) VALUES (?, ?)', array($entity->getId(), $tax->id));
	        }
	        $entity->setTaxes($taxes);
	        $this->getEventManager()->trigger(__FUNCTION__ . '.post', $this, array('entity'=>$entity));
	        $this->getEntityManager()->commit();
		} catch (Exception $e) {
			$connection->rollBack();
			throw $e;
		}
	}
}