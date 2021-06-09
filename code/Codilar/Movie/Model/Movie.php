<?php
namespace  Codilar\Movie\Model;


use Codilar\Movie\Model\ResourceModel\Movie as ResourceModel;
use Magento\Framework\Model\AbstractModel;

class  Movie extends AbstractModel
{
   public  function _construct()
   {
      $this->_init(resourceModel: ResourceModel::class);
   }
}



