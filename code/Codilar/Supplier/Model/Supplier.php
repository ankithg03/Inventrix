<?php

namespace Codilar\Supplier\Model;

use Magento\Framework\Model\AbstractModel;
use Codilar\Supplier\Model\ResourceModel\Supplier as ResourceModel;
/**
 * class Supplier
 *
 */
class Supplier extends AbstractModel
{
    protected function _construct()
    {
        $this->_init(ResourceModel::class);
    }
}
