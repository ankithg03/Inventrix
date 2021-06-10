<?php


namespace Codilar\User\Model\ResourceModel;



use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Work extends AbstractDb
{
    const MAIN_TABLE = 'Codilar_User';
    const ID_FIELD_NAME = 'id';

    protected function _construct()
    {
        $this->_init(self::MAIN_TABLE, self::ID_FIELD_NAME);
    }
}

