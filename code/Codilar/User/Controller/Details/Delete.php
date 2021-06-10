<?php


namespace Codilar\User\Controller\Details;


use Codilar\User\Model\UserManagement;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;

class Delete extends Action
{
    const USER_TABLE = 'Codilar_User';
    private $resourceConnection;
    /**
     * @var
     */
    private $userManagement;

    /**
     * Delete constructor.
     * @param Context $context
     * @param UserManagement $userManagement
     */
    public function __construct(
        Context $context,
        UserManagement $userManagement
    )
    {
        $this->userManagement = $userManagement;
        return parent::__construct($context);
    }

    public function execute()
    {

        $userId = ($this->getRequest()->getParam('id'));
        $this->userManagement->deleteById($userId);
        $redirect = $this->resultRedirectFactory->create();
        $redirect->setPath('user');
        return $redirect;
    }
}
