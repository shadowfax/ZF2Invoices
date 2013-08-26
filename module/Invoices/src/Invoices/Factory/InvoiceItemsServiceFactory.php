<?php
namespace Invoices\Factory;

use Invoices\Service\InvoiceItemsService;

use Zend\ServiceManager\ServiceLocatorInterface;

use Zend\ServiceManager\FactoryInterface;

class InvoiceItemsServiceFactory implements FactoryInterface
{
	public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $service = new InvoiceItemsService();
        $service->setEntityManager($serviceLocator->get('Doctrine\ORM\EntityManager'));
        return $service;
    }
}