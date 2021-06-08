<?php
namespace Dhruvi\Firearm\Model;

use Magento\Framework\Model\AbstractModel;

class Firearm extends AbstractModel{

    protected function _construct()
    {
        $this->_init(\Dhruvi\Firearm\Model\ResourceModel\Firearm::class);
    }
}
