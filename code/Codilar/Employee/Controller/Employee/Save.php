<?php

namespace Codilar\Employee\Controller\Employee;

use Codilar\Employee\Model\EmployeeFactory;
use Codilar\Employee\Model\ResourceModel\Employee as EmployeeResourceModel;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;

class Save extends Action
{
    /**
     * @var employee
     */
    private $employee;

    private $employeeResourceModel;
    /**
     * @var EmployeeFactory
     */
    private $employeeFactory;

    /**
     * Save constructor.
     * @param Context $context
     * @param EmployeeFactory $employeeFactory
     * @param EmployeeResourceModel $employeeResourceModel
     */
    public function __construct(
        Context $context,
        EmployeeFactory $employeeFactory,
        EmployeeResourceModel $employeeResourceModel
    ) {
        $this->employeeResourceModel = $employeeResourceModel;
        parent::__construct($context);
        $this->employeeFactory = $employeeFactory;
    }

    public function execute()
    {
        $params = $this->getRequest()->getParams();
        $employee = $this->employeeFactory->create();
        $employee->setData($params);
        try {
            $this->employeeResourceModel->save($employee);
            $this->messageManager->addSuccessMessage(__("Successfully added the Employee ", $params['name']));
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage(__("Something went wrong."));
        }
        /* Redirect back to hero display page */
        $redirect = $this->resultRedirectFactory->create();
        $redirect->setPath('employee');
        return $redirect;
    }
}

