<?php

namespace Codilar\Employee\Controller\Employee;

use Codilar\Employee\Model\EmployeeManagement;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;

class Delete extends Action
{
    const EMPLOYEE_TABLE = 'Employee_Details';
    private $resourceConnection;
    /**
     * @var
     */
    private $employeeManagement;

    /**
     * Delete constructor.
     * @param Context $context
     * @param EmployeeManagement $employeeManagement
     */
    public function __construct(
        Context $context,
        EmployeeManagement $employeeManagement
    ) {
        $this->employeeManagement = $employeeManagement;
        return parent::__construct($context);
    }

    public function execute()
    {

        $employeeId = ($this->getRequest()->getParam('id'));
        $this->employeeManagement->deleteById($employeeId);
        $redirect = $this->resultRedirectFactory->create();
        $redirect->setPath('employee');
        return $redirect;
    }
}
