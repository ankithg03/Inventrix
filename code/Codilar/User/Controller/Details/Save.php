<?php


namespace Codilar\User\Controller\Details;

use Codilar\User\Model\WorkFactory;
use Codilar\User\Model\ResourceModel\Work as WorkResourceModel;
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

    /**
     * Save constructor.
     * @param Context $context
     * @param WorkFactory $workFactory
     * @param WorkResourceModel $workResourceModel
     */
    public function __construct(
        Context $context,
        WorkFactory $workFactory,
        WorkResourceModel $workResourceModel
    )
    {
        $this->workResourceModel = $workResourceModel;
        parent::__construct($context);
        $this->workFactory = $workFactory;
    }

    public function execute()
    {
        $params = $this->getRequest()->getParams();
        $work = $this->workFactory->create();
        $work->setData($params);//TODO: Challenge Modify here to support the edit save functionality
        try {
            $this->workResourceModel->save($work);
            $this->messageManager->addSuccessMessage(__("Successfully added the User %1", $params['name']));
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage(__("Something went wrong."));
        }
        /* Redirect back to hero display page */
        $redirect = $this->resultRedirectFactory->create();
        $redirect->setPath('user');
        return $redirect;
    }
}

