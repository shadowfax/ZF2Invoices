<?php
namespace Invoices\Factory;

use Invoices\Service\ClientService;

use Zend\ServiceManager\ServiceLocatorInterface;

use Zend\ServiceManager\FactoryInterface;

class ClientServiceFactory implements FactoryInterface
{
	public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $service = new ClientService();
        $service->setEntityManager($serviceLocator->get('Doctrine\ORM\EntityManager'));
        return $service;
    }
}