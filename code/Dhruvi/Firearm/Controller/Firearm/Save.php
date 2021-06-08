<?php

namespace dhruvi\Firearm\Controller\Firearm;

use Dhruvi\Firearm\Model\Firearm;
use Dhruvi\Firearm\Model\ResourceModel\Firearm as FirearmResourceModel;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;

class Save extends Action
{

    private $firearm;

    private $firearmResourceModel;

   
    public function __construct(
        Context $context,
        Firearm $firearm,
        FirearmResourceModel $firearmResourceModel
    ) {
        $this->firearm = $firearm;
        $this->firearmResourceModel = $firearmResourceModel;
        parent::__construct($context);
    }

    public function execute()
    {
        $params = $this->getRequest()->getParams();
        $firearm = $this->firearm->setData($params);
        try {
            $this->firearmResourceModel->save($firearm);
            $this->messageManager->addSuccessMessage(__("Successfully added the Firearm %1", $params['name']));
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage(__("Something went wrong."));
        }
        
        $redirect = $this->resultRedirectFactory->create();
        $redirect->setPath('firearm');
        return $redirect;
    }
}