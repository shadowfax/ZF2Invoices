<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'Invoices\Controller\Index' => 'Invoices\Controller\IndexController',
        ),
    ),
    'router' => array(
        'routes' => array(
            'invoices' => array(
                'type'    => 'Literal',
                'options' => array(
                    // Change this to something specific to your module
                    'route'    => '/invoices',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Invoices\Controller',
                        'controller'    => 'Index',
                        'action'        => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    // This route is a sane default when developing a module;
                    // as you solidify the routes for your module, however,
                    // you may want to remove it and replace it with more
                    // specific routes.
                    'default' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/[:controller[/:action]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'InvoicesModule' => __DIR__ . '/../view',
        ),
    ),
    // Navigation
    'navigation' => array(
        'default' => array(
            'invoices' => array(
				'label' => 'Invoices',
				'route' => 'invoices',
    			'pages' => array(
    				'invoices' => array(
    					'label' => 'Invoices',
						'route' => 'invoices',
    				),
    				'recurring' => array(
    					'label' => 'Recurring',
						'route' => 'invoices',
    					'controller' => 'Recurring',
    				),
    				'received' => array(
    					'label' => 'Received',
						'route' => 'invoices',
    					'controller' => 'Received',
    				),
    				'payments' => array(
    					'label' => 'Payments',
						'route' => 'invoices',
    					'controller' => 'Payments',
    				),
    				'items' => array(
    					'label' => 'Items',
						'route' => 'invoices',
    					'controller' => 'Items',
    				),
    			),
             ),
         ),
     ),
);