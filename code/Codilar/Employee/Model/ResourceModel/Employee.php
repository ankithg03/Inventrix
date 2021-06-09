<?php


namespace Codilar\Employee\Model\ResourceModel;


use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Employee extends AbstractDb
{
    const MAIN_TABLE = 'employee_list';
    /**
     * @var string Primarykey
     */
    protected $_idFieldName  = 'id';
    protected function _construct()
    {
        $this->_init(self::MAIN_TABLE, $this->$_idFieldName );
    }
}
