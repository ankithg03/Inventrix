<?php 
namespace Dhruvi\Firearm\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Firearm extends AbstractDb
{
protected function _construct()
{
    $this->_init('dhruvi_firearm','id');
}
}