<?php 

namespace Codilar\Employee\Controller\Add;

use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\App\ResponseInterface;

class  Index extends Action 
{
    
    public function execute()
    {
        return $this->resultFactory->create(ResultFactory::TYPE_PAGE);
    }
}

