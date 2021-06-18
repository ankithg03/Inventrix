<?php

namespace Codilar\Supplier\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

/**
 * class Supplier
 */
class Supplier extends AbstractDb
{
    const MAIN_TABLE = 'codilar_supplier_info';
    const ID_FIELD_NAME = 'id';

    protected function _construct()
    {
        $this->_init(self::MAIN_TABLE, self::ID_FIELD_NAME);
    }
}
