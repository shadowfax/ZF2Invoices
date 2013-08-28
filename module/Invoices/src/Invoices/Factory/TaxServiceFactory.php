<?php
namespace Invoices\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Invoices\Service\TaxService;

class TaxServiceFactory implements FactoryInterface
{
	public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $service = new TaxService();
        $service->setEntityManager($serviceLocator->get('Doctrine\ORM\EntityManager'));
        return $service;
    }
}