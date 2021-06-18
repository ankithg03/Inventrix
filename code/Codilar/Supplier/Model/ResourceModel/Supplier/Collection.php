<?php

namespace Codilar\Supplier\Model\ResourceModel\Supplier;

use Codilar\Supplier\Model\Supplier as Model;
use Codilar\Supplier\Model\ResourceModel\Supplier as ResourceModel;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
/**
 * class Collection
 *
 */
class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(Model::class, ResourceModel::class);
    }
}
