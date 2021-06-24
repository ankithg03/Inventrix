<?php


namespace Codilar\OutStock\Controller\Customer;

use Codilar\OutStock\Model\OutStock;
use Codilar\OutStock\Model\ResourceModel\OutStock as OutStockResourceModel;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;

class Save extends Action
{

    private $outstock;

    private $outstockResourceModel;


    public function __construct(
        Context $context,
        Outstock $outstock,
        OutstockResourceModel $outstockResourceModel
    )
    {
        $this->outstock = $outstock;
        $this->outstockResourceModel = $outstockResourceModel;
        parent::__construct($context);
    }

    public function execute()
    {

        $params = $this->getRequest()->getParams();
        $outstock = $this->outstock->setData($params);
        try {
            $this->outstockResourceModel->save($outstock);
            $this->messageManager->addSuccessMessage(__("Successfully added the Hero %1", $params['name']));
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage(__("Something went wrong."));
        }

        $redirect = $this->resultRedirectFactory->create();
        $redirect->setRefererUrl();
        return $redirect;
    }
}
