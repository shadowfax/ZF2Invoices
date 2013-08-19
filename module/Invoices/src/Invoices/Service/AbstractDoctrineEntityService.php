<?php

namespace Invoices\Service;

use Doctrine\DBAL\LockMode;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

use Zend\EventManager\EventManager;
use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\EventManagerAwareInterface;

abstract class AbstractDoctrineEntityService implements EventManagerAwareInterface, ServiceLocatorAwareInterface
{
	/**
     * @var EventManagerInterface
     */
    protected $events;
    
    /**
     * @var ServiceLocatorInterface
     */
    protected $serviceLocator;
   
    /**
	 * @var EntityManager
     */
    protected $entityManager;
    
    
    /**
	 * @var EntityRepository
	 */
    protected $entityRepository;
    
	/**
     * Set the event manager instance
     *
     * @param  EventManagerInterface $events
     * @return AbstractDoctrineEntityService
     */
    public function setEventManager(EventManagerInterface $events)
    {
        $events->setIdentifiers(array(
            __CLASS__,
            get_class($this),
        ));
        $this->events = $events;

        return $this;
    }

    /**
     * Retrieve event manager
     *
     * Lazy loads an instance if none registered.
     *
     * @return EventManagerInterface
     */
    public function getEventManager()
    {
        if (null === $this->events) {
            $this->setEventManager(new EventManager());
        }

        return $this->events;
    }
    
	/**
     * Set serviceManager instance
     *
     * @param  ServiceLocatorInterface $serviceLocator
     * @return void
     */
    public function setServiceLocator(ServiceLocatorInterface $serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
    }

    /**
     * Retrieve serviceManager instance
     *
     * @return ServiceLocatorInterface
     */
    public function getServiceLocator()
    {
        return $this->serviceLocator;
    }
    
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
     * Sets an instance of the Doctrine entity manager.
     *
     * @param EntityManager $entityManager
     */
    public function setEntityManager(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    
    /**
	 * Gets the entity repository.
	 *
	 * @return EntityRepository
	 */
    abstract public function getEntityRepository();
    
    /**
     * Sets the entity repository
	 *
	 * @param EntityRepository $entityRepository
	 * @return AbstractDoctrineEntityService
	 */
	public function setEntityRepository(EntityRepository $entityRepository)
    {
        $this->entityRepository = $entityRepository;
        return $this;
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
        $entities = $this->getEntityRepository()->findAll();
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
    public function find($id, $lockMode = LockMode::NONE, $lockVersion = null)
    {
    	$entity = null;
    	$this->getEventManager()->trigger(__FUNCTION__ . '.pre', $this, array('id' => $id, 'entity' => $entity));
    	$entity = $this->getEntityRepository()->find($id, $lockMode, $lockVersion);
    	$this->getEventManager()->trigger(__FUNCTION__ . '.post', $this, array('id' => $id, 'entity' => $entity));
    	return $entity;
    }
    
	/**
     * Tells the EntityManager to make an instance managed and persistent.
     *
     * The entity will be entered into the database at or before transaction
     * commit or as a result of the flush operation.
     *
     * NOTE: The persist operation always considers entities that are not yet known to
     * this EntityManager as NEW. Do not pass detached entities to the persist operation.
     *
     * @param object $object The instance to make managed and persistent.
     */
    public function persist($entity)
    {
    	$this->getEventManager()->trigger(__FUNCTION__ . '.pre', $this, array('entity'=>$entity));
        $this->getEntityManager()->persist($entity);
        $this->getEntityManager()->flush($entity);
        $this->getEventManager()->trigger(__FUNCTION__ . '.post', $this, array('entity'=>$entity));
    }
    
	/**
     * Removes an entity instance.
     *
     * A removed entity will be removed from the database at or before transaction commit
     * or as a result of the flush operation.
     *
     * @param object $entity The entity instance to remove.
     */
    public function remove($entity)
    {
        $this->getEventManager()->trigger(__FUNCTION__ . '.pre', $this, array('entity'=>$entity));
        $this->getEntityManager()->remove($entity);
        $this->getEntityManager()->flush($entity);
        $this->getEventManager()->trigger(__FUNCTION__ . '.post', $this, array('entity'=>$entity));
    }
}