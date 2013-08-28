<?php


namespace Invoices\Service;


use Doctrine\DBAL\Query\QueryBuilder;
Use Invoices\Entity\Tax;

class TaxService extends AbstractDoctrineEntityService
{
	/**
	 * (non-PHPdoc)
	 * @see module/Invoices/src/Invoices/Service/Invoices\Service.AbstractDoctrineEntityService::getEntityRepository()
	 * @return Invoices\Entity\Tax
	 */
	public function getEntityRepository()
	{
		if (null === $this->entityRepository) {
            $this->setEntityRepository($this->getEntityManager()->getRepository('Invoices\Entity\Tax'));
        }
        return $this->entityRepository;
	}
	
	private function getMaxId()
	{
		$qb = $this->getEntityManager()->createQueryBuilder();
		$qb->select('MAX(tax.id)');
		$qb->from('Invoices\Entity\Tax', 'tax');
		$qb->where('tax.company_id = :company_id');
		$qb->setParameters(array(
			'company_id' => $this->getCompany()->id
		));
		
		$result = $qb->getQuery()->getScalarResult();
		return (int)$result[0][1];
		
	}
	
	/**
     * Finds all entities in the repository.
     *
     * @return array The entities.
     */
    public function findAll()
    {
    	$entities = array();
    	$this->getEventManager()->trigger(__FUNCTION__ . '.pre', $this, array('entities' => $entities));
        $entities = $this->getEntityRepository()->findBy(array('company_id' => $this->getCompany()->id));
        $this->getEventManager()->trigger(__FUNCTION__ . '.post', $this, array('entities' => $entities));
        return $entities;
    }
    
	/**
     * Finds a single entity by a set of criteria.
     *
     * @param array $criteria
     * @param array|null $orderBy
     * @return object
     */
    public function findOneBy(array $criteria, array $orderBy = null)
    {
    	$criteria = array_merge($criteria, array('company_id', $this->getCompany()->id));
    	$entity = null;
    	$this->getEventManager()->trigger(__FUNCTION__ . '.pre', $this, array('criteria' => $criteria, 'entity' => $entity));
        $entity = $this->getEntityRepository()->findOneBy( $criteria, $orderby );
        $this->getEventManager()->trigger(__FUNCTION__ . '.post', $this, array('criteria' => $criteria, 'entity' => $entity));
        return $entity;
    }
    
	/**
     * Finds an entity by its primary key / identifier.
     *
     * @param mixed $id The identifier.
     * @param integer $lockMode
     * @param integer $lockVersion
     *
     * @return object The entity.
     */
    public function find($id)
    {
    	$entity = null;
    	$this->getEventManager()->trigger(__FUNCTION__ . '.pre', $this, array('id' => $id, 'entity' => $entity));
    	$entity = $this->getEntityRepository()->findOneBy(array('company_id' => $this->getCompany()->id, 'id' => $id));
    	$this->getEventManager()->trigger(__FUNCTION__ . '.post', $this, array('id' => $id, 'entity' => $entity));
    	return $entity;
    }
    
    public function findBy(array $criteria, array $orderBy = null)
    {
    	$criteria = array_merge($criteria, array('company_id', $this->getCompany()->id));
    	$entity = null;
    	$this->getEventManager()->trigger(__FUNCTION__ . '.pre', $this, array('criteria' => $criteria, 'entity' => $entity));
        $entity = $this->getEntityRepository()->findBy( $criteria, $orderby );
        $this->getEventManager()->trigger(__FUNCTION__ . '.post', $this, array('criteria' => $criteria, 'entity' => $entity));
        return $entity;
    }
    
	public function persist($entity)
	{
		if (empty($entity->company_id)) {
			$entity->company_id = $this->getCompany()->id;
			
		} 
		if (empty($entity->equalization)) {
			$entity->equalization = "0.0";
		}
		
		if (empty($entity->id)) {
			$entity->id         = $this->getMaxId() + 1;
		}

		parent::persist($entity);
	}
}