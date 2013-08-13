<?php
namespace Settings\Navigation\Service;

use Zend\Navigation\Service\DefaultNavigationFactory;

class SettingsNavigationFactory extends DefaultNavigationFactory
{
    protected function getName()
    {
        return 'settings-nav';
    }
}