<?php
namespace Invoices;

return array(
    'controllers' => array(
        'invokables' => array(
            'Invoices\Controller\Invoice' => 'Invoices\Controller\InvoiceController',
			'Invoices\Controller\Items' => 'Invoices\Controller\ItemsController',
			'Invoices\Controller\Settings' => 'Invoices\Controller\SettingsController',
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
                        'controller'    => 'invoice',
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
                            'route'    => '/[:controller[/:action[/:id]]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                				'id'         => '[0-9]+',
                            ),
                            'defaults' => array(
                            ),
                        ),
                    ),
                ),
            ),
            'settings' => array(
                'type'    => 'Literal',
                'options' => array(
                    // Change this to something specific to your module
                    'route'    => '/settings',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Invoices\Controller',
                        'controller'    => 'settings',
                        'action'        => 'company',
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
                            'route'    => '/[:action]',
                            'constraints' => array(
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                            	'action' => 'company'
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
    'service_manager' => array(
		'factories' => array(
			'settings_navigation' => 'Invoices\Navigation\Service\SettingsNavigationFactory'
		),
	),
    // Navigation
    'navigation' => array(
        'default' => array(
            'invoices' => array(
				'label' => 'Invoices',
				'route' => 'invoices/default',
    			'controller' => 'invoice',
    			'resource' => 'invoices',
    			'pages' => array(
    				'invoices' => array(
    					'label' => 'Invoices',
						'route' => 'invoices/default',
    					'controller' => 'invoice',
    					'resource' => 'invoices'
    				),
    				/*
    				'recurring' => array(
    					'label' => 'Recurring',
						'route' => 'invoices/default',
    					'controller' => 'Recurring',
    				),
    				'received' => array(
    					'label' => 'Received',
						'route' => 'invoices/default',
    					'controller' => 'Received',
    				),
    				*/
    				'payments' => array(
    					'label' => 'Payments',
						'route' => 'invoices/default',
    					'controller' => 'payments',
    					'resource' => 'invoices/payments',
    				),
    				'items' => array(
    					'label' => 'Items',
						'route' => 'invoices/default',
    					'controller' => 'items',
    					'resource' => 'invoices/items',
    				),
    			),
             ),
         ),
         'settings-nav' => array(
    		'company' => array(
				'label' => 'Company',
				'route' => 'settings'
			),
			'taxes' => array(
				'label' => 'Taxes',
				'route' => 'settings/default',
				'action' => 'taxes'
			),
    	)
     ),
     // Doctrine config
    'doctrine' => array(
        'driver' => array(
            __NAMESPACE__ . '_driver' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(__DIR__ . '/../src/' . __NAMESPACE__ . '/Entity')
            ),
            'orm_default' => array(
                'drivers' => array(
                    __NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver'
                )
            )
        )
    ),
);