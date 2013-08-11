<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;


use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
// Sessions
use Zend\Session\SessionManager;
use Zend\Session\SaveHandler\DbTableGatewayOptions;
use Zend\Session\SaveHandler\DbTableGateway;
use Zend\Db\TableGateway\TableGateway;

class Module
{
    public function onBootstrap(MvcEvent $e)
    {
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
        
        // No layout for errors
        $eventManager->attach(MvcEvent::EVENT_DISPATCH_ERROR, function($e) {
             $result = $e->getResult();
             $result->setTerminal(TRUE);
		});
		
		//Initiate session
		$this->initSession($e);
    }

    private function initSession(MvcEvent $e)
    {
    	//die("Init session - Start");
    	// grab the config array
        $serviceManager = $e->getApplication()->getServiceManager();
        $config         = $serviceManager->get('config');
        $adapter        = $serviceManager->get('Zend\Db\Adapter\Adapter');
        
    	$tableGateway   = new TableGateway('sessions', $adapter);
		$saveHandler    = new DbTableGateway($tableGateway, new DbTableGatewayOptions());
		$manager        = new SessionManager();
		$manager->setSaveHandler($saveHandler);
		$manager->start();
    }
    
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
}
