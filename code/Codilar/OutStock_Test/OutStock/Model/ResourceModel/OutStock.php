<?php

namespace Codilar\OutStock\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
/**
 * class OutStock
 */
class OutStock extends AbstractDb
{
    const MAIN_TABLE = 'stock_information';
    const ID_FIELD_NAME = 'id';

    protected function _construct()
    {
        $this->_init(self::MAIN_TABLE, self::ID_FIELD_NAME);
    }
}
