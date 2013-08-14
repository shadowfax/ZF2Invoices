<?php
namespace Invoices\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class InvoiceController extends AbstractActionController
{
    public function indexAction()
    {
        return new ViewModel();
    }
}
