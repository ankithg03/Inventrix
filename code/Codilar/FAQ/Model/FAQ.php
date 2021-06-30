<?php

namespace Codilar\FAQ\Model;
use Magento\Framework\Model\AbstractModel;
use Codilar\FAQ\Model\ResourceModel\FAQ as ResourceModel;

class FAQ extends AbstractModel
{
    /**
     *  Getting ResourceModel
     */
    protected function _construct()
    {
        $this->_init(ResourceModel::class);
    }


}
