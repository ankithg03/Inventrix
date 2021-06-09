<?php

namespace Codilar\Employee\Controller\Add;

use Codilar\Employee\Model\MobileManagement;
use Magento\Framework\App\Action\Action;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\App\ResponseInterface;

class Save extends Action
{
     
    /**
     * @var EmployeeMangement
     */
    private $employeeMangement;
    /**
     * Save constructor.
     * @param Context $context
     * @param EmployeeManagement $employeeManagement
     */
    public function __construct(
        Context $context,
        EmployeeMangement $employeeMangement,
    ){
        parent::__construct($context);
        $this->employeeMangement = $employeeMangement;
        
    }
    
    public function execute()
    {
        $resultRedirect = $this->reultFactory->create(ResultFactory::TYPE_REDIRECT);
        #$_POST
        $name=$this->_request->getParam('employee_name');
        $companyname=$this->_request->getParam('employee_companyname');
        $saveResult=false;
        /**
         * to check if data is recieved and if it is recieved then check if it is empty
         */
        if(isset($name) && isset($companyname &&!empty($name) &&!empty($companyname)))
        {
            $saveResult = $this->employeeManagement->save($name,$companyname);
        }
        if($saveResult)
        {
            $this->messageManager->addSuccessMessage(__("Successfully added the Employee "));
        }
        else{
            $this->messageManager->addErrorMessage(__("Something went wrong."));
        }
        $resultRedirect->setUrl($this->_url->getUrl('employee/index/index'));
        return $resultRedirect;
    }
}
    
