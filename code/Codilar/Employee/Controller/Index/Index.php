<?php

namespace Codilar\Employee\Controller\Index;

use Magento\Framework\App\Action\Action;;
use Magento\Framework\Controller\ResultFactory;

class Index extends Action
{
     /**
     * @return ResponseInterface|\Magento\Framework\Controller\ResultInterface|\Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        $resultResponse = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        return $resultResponse;
    }
}
