<?php

namespace Codilar\FAQ\Model\ResourceModel\FAQGroup;

use Codilar\FAQ\Model\FAQGroup as Model;
use Codilar\FAQ\Model\ResourceModel\FAQGroup as ResourceModel;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
/**
 * class Collection
 */
class Collection extends AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = 'id';

    protected function _construct()
    {
        $this->_init(Model::class, ResourceModel::class);
    }


}
