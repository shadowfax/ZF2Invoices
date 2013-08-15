<?php
namespace Invoices;

return array(
    'controllers' => array(
        'invokables' => array(
            'Invoices\Controller\Invoice' => 'Invoices\Controller\InvoiceController',
			'Invoices\Controller\Items' => 'Invoices\Controller\ItemsController',
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
				'route' => 'invoices/default',
    			'controller' => 'invoice',
    			'pages' => array(
    				'invoices' => array(
    					'label' => 'Invoices',
						'route' => 'invoices/default',
    					'controller' => 'invoice'
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
    					'controller' => 'Payments',
    				),
    				'items' => array(
    					'label' => 'Items',
						'route' => 'invoices/default',
    					'controller' => 'items',
    				),
    			),
             ),
         ),
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