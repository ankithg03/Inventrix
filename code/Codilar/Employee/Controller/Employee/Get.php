<?php


namespace Codilar\Employee\Controller\Employee;


use Codilar\Employee\Model\EmployeeManagement;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Serialize\Serializer\Json;

class Get extends Action
{
    /**
     * @var EmployeeManagement
     */
    private $employeeManagement;
    /**
     * @var Json
     */
    private $json;

    /**
     * Get constructor.
     * @param Context $context
     * @param EmployeeManagement $employeeManagement
     * @param Json $json
     */
    public function __construct(Context $context, EmployeeManagement $employeeManagement, Json $json)
    {
        parent::__construct($context);
        $this->employeeManagement = $employeeManagement;
        $this->json = $json;
    }

    /**
     * @inheritDoc
     */
    public function execute()
    {
        $jsonResponseFactory = $this->resultFactory->create(ResultFactory::TYPE_JSON);
        $jsonData = $this->json->serialize($this->employeeManagement->getData());
        $jsonResponseFactory->setData($jsonData);
        return $jsonResponseFactory;
    }
}
