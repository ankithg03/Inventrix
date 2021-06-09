<?php
namespace  Codilar\Movie\Model\ResourceModel;


use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class  Movie extends AbstractDb
{
    const  TABLE_NAME ="codilar_movie_info";

    protected $_idFieldName ="movie_id";

    protected function _construct()
    {
        $this->_init(self::TABLE_NAME  , $this->_idFieldName );
    }
}
