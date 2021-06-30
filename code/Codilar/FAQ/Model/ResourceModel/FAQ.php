<?php

namespace Codilar\FAQ\Model\ResourceModel;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
/**
 * class FAQ
 */
class FAQ extends AbstractDb
{
    const MAIN_TABLE = 'faq_ques_ans';
    const ID_FIELD_NAME = 'id';

    protected function _construct()
    {
        $this->_init(self::MAIN_TABLE, self::ID_FIELD_NAME);
    }
}

