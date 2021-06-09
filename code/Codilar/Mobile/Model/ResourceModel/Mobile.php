<?php
namespace  Codilar\Mobile\Model\ResourceModel;


use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class  Mobile extends AbstractDb
{
    const  TABLE_NAME ="codilar_mobile_info";

    protected $_idFieldName ="mobile_id";

    protected function _construct()
    {
        $this->_init(self::TABLE_NAME  , $this->_idFieldName );
    }
}
