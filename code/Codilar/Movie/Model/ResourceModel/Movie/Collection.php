<?php
namespace Codilar\Movie\Model\ResourceModel\Movie;


use Codilar\Movie\Model\Movie as Model;
use Codilar\Movie\Model\ResourceModel\Movie as ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends  AbstractCollection
{

    protected  function _construct()
    {
       $this->_init(model:Model ::class, resourceModel: ResourceModel::class);
    }

}
