<?php

namespace Codilar\Employee\Block;

use Codilar\Employee\Model\ResourceModel\Work\Collection;
use Magento\Framework\View\Element\Template;
use Codilar\Employee\Model\EmployeeManagement;
use Codilar\Employee\Model\ResourceModel\Work\CollectionFactory;

class Display extends Template
{
    
    private $collection;

    /**
     * @var CollectionFactory
     */
    private $collectionFactory;
    /**
     * @var EmployeeManagement
     */
    private $employeeManagement;


    /**
     * Display constructor.
     * @param Template\Context $context
     * @param Collection $collection
     * @param array $data
     */
    public function __construct(
        Template\Context $context,
        EmployeeManagement $employeeManagement,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->employeeManagement = $employeeManagement;
    }

    /**
     * @return Collection
     */

    public function getAllEmployees()
    {
        $data = $this->employeeManagement->getData();
        $writer = new \Zend\Log\Writer\Stream(BP . '/var/log/test.log');
        $logger = new \Zend\Log\Logger();
        $logger->addWriter($writer);
        $logger->info(json_encode($data));
        return $data;
    }
    /**
     * @return string
     */
    public function getPostUrl()
    { 
        return $this->getUrl('employee/details/save');

    }

    

}

?>
