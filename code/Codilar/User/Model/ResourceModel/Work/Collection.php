<?php


namespace Codilar\User\Model\ResourceModel\Work;


use Codilar\User\Model\Work;
use Codilar\User\Model\ResourceModel\Work as WorkEmployee;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(Work::class, WorkEmployee::class);
    }
}
