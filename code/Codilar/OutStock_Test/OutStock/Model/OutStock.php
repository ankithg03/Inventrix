<?php

namespace Codilar\OutStock\Model;

use Magento\Framework\Model\AbstractModel;
use Codilar\OutStock\Model\ResourceModel\OutStock as ResourceModel;

class OutStock extends AbstractModel
{
    /**
     *  Getting ResourceModel
     */
    protected function _construct()
    {
        $this->_init(ResourceModel::class);
    }
}
