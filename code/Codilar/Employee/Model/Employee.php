<?php


namespace Codilar\Employee\Model;


use Codilar\Employee\Model\ResourceModel\Employee as ResourceModel;
use Magento\Framework\Model\AbstractModel;

class Employee extends AbstractModel
{
    protected function _construct()
    {
        $this->_init(resouceModel: ResourceModel::class);
    }
}
