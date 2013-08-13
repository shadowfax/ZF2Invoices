<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'Settings\Controller\Company' => 'Settings\Controller\CompanyController',
			'Settings\Controller\Taxes' => 'Settings\Controller\TaxesController',
        ),
    ),
    'router' => array(
        'routes' => array(
            'settings' => array(
                'type'    => 'Literal',
                'options' => array(
                    // Change this to something specific to your module
                    'route'    => '/settings',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Settings\Controller',
                        'controller'    => 'company',
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
                            	'action' => 'index'
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'SettingsModule' => __DIR__ . '/../view',
        ),
    ),
    // No default navigation as I don't want it shown in the main menu!
    // However we need a navigation for the module to show the internal menu
    'service_manager' => array(
		'factories' => array(
			'settings_navigation' => 'Settings\Navigation\Service\SettingsNavigationFactory'
		),
	),
    'navigation' => array(
    	'settings-nav' => array(
    		'company' => array(
				'label' => 'Company',
				'route' => 'settings'
			),
			'taxes' => array(
				'label' => 'Taxes',
				'route' => 'settings/default',
				'controller' => 'taxes',
				'action' => 'index'
			),
    	)
    )
);