<?php

namespace Codilar\Supplier\Controller\Adminhtml\Info;

use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\App\Action\Action;

/**
 * Class Edit
 *
 * @description A magento 2 module to have Suppliers for products
 * @author   Codilar Team Player <bhaktahari.p@codilar.com>
 *
 * A magento 2 module to have Suppliers for products
 */
class Edit extends Action
{
    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $resultResponse = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $resultResponse->getConfig()->getTitle()->set(__("Lets edit the Supplier"));
        return $resultResponse;
    }
}
