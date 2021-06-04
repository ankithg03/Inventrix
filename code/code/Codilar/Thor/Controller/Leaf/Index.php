<?php

namespace Codilar\Thor\Controller\Leaf;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultFactory;

class Index extends Action
{
    /**
     * @inheritDoc
     */
    public function execute()
    {
        $pageResult = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        return $pageResult;
    }
}
