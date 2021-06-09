<?php
namespace Codilar\Mobile\Model\ResourceModel\Mobile;


use Codilar\Mobile\Model\Mobile as Model;
use Codilar\Mobile\Model\ResourceModel\Mobile as ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends  AbstractCollection
{

    protected  function _construct()
    {
       $this->_init(model:Model ::class, resourceModel: ResourceModel::class);
    }

}


