<?php
/**
 *   Name - Sanjay Kumar Das
 *   Email - sanjay.d@gmail.com
 *   Author - Sanjay
 */
namespace   Codilar\OutStock\Controller\Adminhtml\Info;
use Magento\Framework\App\Action\Action;
use Magento\Framework\Controller\ResultFactory;


class Add extends Action
{
    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $resultResponse = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $resultResponse->getConfig()->getTitle()->set(__("  OutStock Of Stock Management"));
        return $resultResponse;
    }
}

