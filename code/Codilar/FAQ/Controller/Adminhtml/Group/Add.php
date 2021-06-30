<?php

namespace   Codilar\FAQ\Controller\Adminhtml\Group;
use Magento\Framework\App\Action\Action;
use Magento\Framework\Controller\ResultFactory;

class Add extends Action
{
    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
//         echo "Hitt";
//         die();
        $resultResponse = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $resultResponse->getConfig()->getTitle()->set(__("Add FAQ Group"));
        return $resultResponse;
    }
}

