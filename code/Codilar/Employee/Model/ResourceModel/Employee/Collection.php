<?php


namespace Codilar\Employee\Model\ResourceModel\Employee;


use Codilar\Employee\Model\Employee;
use Codilar\Employee\Model\ResourceModel\Employee as EmployeeResourceModel;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(Employee::class, EmployeeResourceModel::class);
    }
}
