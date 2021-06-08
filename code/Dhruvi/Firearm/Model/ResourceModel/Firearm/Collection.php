<?php
namespace Dhruvi\Firearm\Model\ResourceModel\Firearm;

use Dhruvi\Firearm\Model\Firearm;
use Dhruvi\Firearm\Model\ResourceModel\Firearm as ResourceModelFirearm;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(Firearm::class, ResourceModelFirearm::class);
    }
}