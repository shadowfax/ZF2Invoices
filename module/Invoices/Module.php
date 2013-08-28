<?php
namespace Invoices;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;

class Module implements AutoloaderProviderInterface
{
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
		    // if we're in a namespace deeper than one level we need to fix the \ in the path
                    __NAMESPACE__ => __DIR__ . '/src/' . str_replace('\\', '/' , __NAMESPACE__),
                ),
            ),
        );
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function onBootstrap(MvcEvent $e)
    {
        // You may not need to do this if you're doing it elsewhere in your
        // application
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
    }
    
	public function getServiceConfig()
	{
		return array(
			'factories' => array(
				'invoices.service.client' => 'Invoices\Factory\ClientServiceFactory',
				'invoices.service.items'  => 'Invoices\Factory\InvoiceItemsServiceFactory',
				'invoice_service.taxes'  => 'Invoices\Factory\TaxServiceFactory',
			)
		);
	}
	
	public function getViewHelperConfig() 
	{
	    return array(
	        'invokables' => array(
	            'formHorizontalRow' => 'Invoices\Form\View\Helper\FormHorizontalRow'
	        )
	    );
	}
}