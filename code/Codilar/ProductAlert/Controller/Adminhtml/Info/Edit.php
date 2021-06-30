<?php

namespace Codilar\Merchant\Controller\Adminhtml\Info;

use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\App\Action\Action;

class Edit extends Action
{
    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $resultResponse = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $resultResponse->getConfig()->getTitle()->set(__("Lets edit the Merchant"));
        return $resultResponse;
    }
}
