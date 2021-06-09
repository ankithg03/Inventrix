<?php
namespace Codilar\Movie\Controller\Index;


use Magento\Framework\App\Action\Action;
use Magento\Framework\Controller\ResultFactory;

class Index extends Action
{
    public function execute()
    {
      $resultResponse= $this->resultFactory->create(ResultFactory::TYPE_PAGE);
      return $resultResponse;
    }
}


