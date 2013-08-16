<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;


use Zend\ModuleManager\ModuleManager;

use Zend\Mvc\Router\RouteMatch;

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
		
		// Force authentication
		$serviceManager = $e->getApplication()->getServiceManager();
		$auth           = $serviceManager->get('zfcuser_auth_service');
		
		$eventManager->attach(MvcEvent::EVENT_ROUTE, function($e) use ($auth) {
            $match = $e->getRouteMatch();

            // No route match, this is a 404
            if (!$match instanceof RouteMatch) {
                return;
            }
            // White list (Accesible routes without auth)
			$list = array('zfcuser/login');
			
            // Route is whitelisted
            $name = $match->getMatchedRouteName();
            if (in_array($name, $list)) {
                return;
            }

            // User is authenticated
            if ($auth->hasIdentity()) {
                return;
            }

            // Redirect to the user login page, as an example
            $router   = $e->getRouter();
            $url      = $router->assemble(array(), array(
                'name' => 'zfcuser/login'
            ));

            $response = $e->getResponse();
            $response->getHeaders()->addHeaderLine('Location', $url);
            $response->setStatusCode(302);

            return $response;
        }, -100);
        
        // Add ACL information to the Navigation view helper
        $authorize = $serviceManager->get('BjyAuthorize\Service\Authorize');
        $acl       = $authorize->getAcl();
        $role      = $authorize->getIdentity();
        \Zend\View\Helper\Navigation::setDefaultAcl($acl);
        \Zend\View\Helper\Navigation::setDefaultRole($role);
    }

	public function init(ModuleManager $moduleManager)
    {
        $sharedEvents = $moduleManager->getEventManager()->getSharedManager();
        $sharedEvents->attach('ZfcUser', 'dispatch', function($e) {
        	// This event will only be fired when an ActionController under the ZfcUser namespace is dispatched.
        	$controller = $e->getTarget();
        	$controller->layout('layout/blank');
    	}, 100);
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
