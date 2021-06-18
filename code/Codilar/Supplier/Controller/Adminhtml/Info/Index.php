<?php

namespace   Codilar\Supplier\Controller\Adminhtml\Info;

use Magento\Framework\App\Action\Action;
use Magento\Framework\Controller\ResultFactory;
/**
 * Class Index
 * @description A magento 2 module to have Suppliers for products
 *
 * A magento 2 module to have Suppliers for product
 */

class Index extends Action
{
    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $resultResponse = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $resultResponse->getConfig()->getTitle()->set(__("Supplier Information"));
        return $resultResponse;
    }
}
