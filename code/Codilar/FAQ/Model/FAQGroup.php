<?php

namespace Codilar\FAQ\Model;
use Magento\Framework\Model\AbstractModel;
use Codilar\FAQ\Model\ResourceModel\FAQGroup as ResourceModel;

class FAQGroup extends AbstractModel
{
    /**
     *  Getting ResourceModel
     */
    protected function _construct()
    {
        $this->_init(ResourceModel::class);
    }


}
