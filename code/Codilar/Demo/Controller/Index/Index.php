<?php
namespace Codilar\Demo\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\View\Result\PageFactory;

class Index extends Action {
    
    private $pageFactory;

    public function __construct(
        Context $context,
        PageFactory $pageFactory
    )

    {
        parent::__construct($context);
        $this->pageFactory = $pageFactory;
    }


    public function execute()
    {
        $page = $this->pageFactory->create();
        return $page;
    }
}

?>