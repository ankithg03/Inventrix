<?php
namespace Codilar\FAQ\Model\ResourceModel\FAQ;

use Codilar\FAQ\Model\FAQ as Model;
use Codilar\FAQ\Model\ResourceModel\FAQ as ResourceModel;
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
