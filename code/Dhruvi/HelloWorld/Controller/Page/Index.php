<?php
namespace Dhruvi\HelloWorld\Controller\Page;
use Magento\Framework\Controller\ResultFactory;

/**
 * Catalog index page controller.
 */
class Index extends \Magento\Framework\App\Action\Action 
{
    public function execute()
    {
        //echo "Hello World";
        //$resultRedirect = $this->resultRedirectFactory->create();
        //return $resultRedirect->setPath('/');
        $page = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        return $page;
        
    }
}
?>