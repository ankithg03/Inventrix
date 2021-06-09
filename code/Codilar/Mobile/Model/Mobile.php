<?php
namespace  Codilar\Mobile\Model;


use Codilar\Mobile\Model\ResourceModel\Mobile as ResourceModel;
use Magento\Framework\Model\AbstractModel;

class  Mobile extends AbstractModel
{
   public  function _construct()
   {
      $this->_init(resourceModel: ResourceModel::class);
   }
}



