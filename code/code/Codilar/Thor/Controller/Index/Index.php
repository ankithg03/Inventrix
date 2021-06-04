<?php

namespace Codilar\Thor\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\ResponseInterface;

class Index extends Action
{
    /**
     * @inheritDoc
     */
    public function execute()
    {
       echo "hello World";
       die;
    }
}
