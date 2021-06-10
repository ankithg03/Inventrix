<?php


namespace Codilar\Employee\Model\ResourceModel\Work;


use Codilar\Employee\Model\Work;
use Codilar\Employee\Model\ResourceModel\Work as WorkEmployee;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(Work::class, WorkEmployee::class);
    }
}
?>