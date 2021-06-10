<?php


namespace Codilar\User\Model;



use Magento\Framework\Model\AbstractModel;

class Work extends AbstractModel
{
    protected function _construct()
    {
        $this->_init(ResourceModel\Work::class);
    }
}

