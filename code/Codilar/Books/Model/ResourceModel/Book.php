<?php


namespace Codilar\Books\Model\ResourceModel;


use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Book extends AbstractDb
{
    const MAIN_TABLE = 'codilar_books';
    const ID_FIELD_NAME = 'id';

    protected function _construct()
    {
        $this->_init(self::MAIN_TABLE, self::ID_FIELD_NAME);
    }
}
