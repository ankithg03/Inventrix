<?php

namespace Codilar\Employee\Controller\Details;

use Codilar\Employee\Model\WorkFactory;
use Codilar\Employee\Model\ResourceModel\Work as WorkResourceModel;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;

class Save extends Action
{
    /**
     * @var work
     */
    private $work;
    
    private $workResourceModel;

    /**
     * @var WorkFactory
     */
    private $workFactory;


    public function __construct(
        Context $context,
        WorkFactory $workFactory,
        WorkResourceModel $workResourceModel
    ) {
        $this->workResourceModel = $workResourceModel;
        parent::__construct($context);
        $this->workFactory = $workFactory;
    }

    public function execute()
    {
        $params = $this->getRequest()->getParams();
        $work = $this->workFactory->create();
        $work->setData($params);
        //$work = $this->work->setData($params);//TODO: Challenge Modify here to support the edit save functionality
        try {
            $this->workResourceModel->save($work);
            $this->messageManager->addSuccessMessage(__("Successfully added the Employee %1", $params['name']));
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage(__("Something went wrong."));
        }
        /* Redirect back to hero display page */
        $redirect = $this->resultRedirectFactory->create();
        $redirect->setPath('employee');
        return $redirect;
    }
}

