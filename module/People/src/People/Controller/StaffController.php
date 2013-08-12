<?php
namespace People\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class StaffController extends AbstractActionController
{
    public function indexAction()
    {
        return new ViewModel();
    }
    
}
