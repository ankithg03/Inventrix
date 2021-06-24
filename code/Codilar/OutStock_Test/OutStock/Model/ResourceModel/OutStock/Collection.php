<?php

namespace Codilar\OutStock\Model\ResourceModel\OutStock;

use Codilar\OutStock\Model\OutStock as Model;
use Codilar\OutStock\Model\ResourceModel\OutStock as ResourceModel;
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
