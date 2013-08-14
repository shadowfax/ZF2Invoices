<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'People\Controller\Clients' => 'People\Controller\ClientsController',
			'People\Controller\Staff' => 'People\Controller\StaffController',
        ),
    ),
    'router' => array(
        'routes' => array(
            'people' => array(
                'type'    => 'Literal',
                'options' => array(
                    // Change this to something specific to your module
                    'route'    => '/people',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'People\Controller',
                        'controller'    => 'Clients',
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
            'PeopleModule' => __DIR__ . '/../view',
        ),
    ),
    // Navigation
    'navigation' => array(
        'default' => array(
            'people' => array(
				'label' => 'People',
				'route' => 'people/default',
    			'controller' => 'clients',
    			'pages' => array(
    				'clients' => array(
    					'label' => 'Clients',
						'route' => 'people/default',
    					'controller' => 'clients'
    				),
    				'users' => array(
    					'label' => 'Staff and Contractors',
						'route' => 'people/default',
    					'controller' => 'Staff',
    					'action' => 'index'
    				),
    			), 
             ),
         ),
     ),
);