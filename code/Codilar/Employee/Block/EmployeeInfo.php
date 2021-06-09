<?php

namespace Codilar\Employee\Block;

use Codilar\Employee\Model\ResourceModel\Employee\Collection;
use Magento\Framework\View\Element\Template;

class EmployeeInfo extends Template
{
    public  function getEmployeeName(){
        return "Musklin";
   }
}




//    /**
//      * @var Collection
//      */
//     private $collection;

//     /**
//      * Display constructor.
//      * @param Template\Context $context
//      * @param Collection $collection
//      * @param array $data
//      */
//     public function __construct(
//         Template\Context $context,
//         Collection $collection,
//         array $data = []
//     ) {
//         $this->collection = $collection;
//         parent::__construct($context, $data);
//     }

//     /**
//      * @return Collection
//      */
//     public function getAllEmployee()
//     {
//         return $this->collection;
//     }

//     /**
//      * @return string
//      */
//     public function getPostUrl()
//     {
//         return $this->getUrl('employee/employee/save');
//     }