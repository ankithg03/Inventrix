<?php

namespace Codilar\User\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\View\Result\PageFactory;

class Index extends Action
{
    private $pageFactory;


    /**
     * Index constructor.
     * @param Context $context
     * @param PageFactory $pageFactory
     */
    public function __construct(
        Context $context,
        PageFactory $pageFactory
    ) {
        parent::__construct($context);
        $this->pageFactory = $pageFactory;
    }

    public function execute()
    {
        $this->_view->getPage()->getConfig()->getTitle()->set(__("Users Details"));
        return $this->resultFactory->create(ResultFactory::TYPE_PAGE);
    }
}
?>
