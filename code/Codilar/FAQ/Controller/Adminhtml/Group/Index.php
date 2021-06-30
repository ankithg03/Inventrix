<?php
namespace   Codilar\FAQ\Controller\Adminhtml\Group;
use Magento\Framework\App\Action\Action;
use Magento\Framework\Controller\ResultFactory;

class Index extends Action
{
    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
//        echo "Hit";
//        die();
        $resultResponse = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $resultResponse->getConfig()->getTitle()->set(__("Create FAQ Group"));
        return $resultResponse;
    }
}
