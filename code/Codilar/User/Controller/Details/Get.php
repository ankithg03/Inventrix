<?php


namespace Codilar\User\Controller\Details;



use Codilar\User\Model\UserManagement;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Serialize\Serializer\Json;

class Get extends Action
{
    /**
     * @var UserManagement
     */
    private $userManagement;
    /**
     * @var Json
     */
    private $json;

    /**
     * Get constructor.
     * @param Context $context
     * @param UserManagement $userManagement
     * @param Json $json
     */
    public function __construct(Context $context, UserManagement $userManagement, Json $json)
    {
        parent::__construct($context);
        $this->userManagement = $userManagement;
        $this->json = $json;
    }

    /**
     * @inheritDoc
     */
    public function execute()
    {
        $jsonResponseFactory = $this->resultFactory->create(ResultFactory::TYPE_JSON);
        $jsonData = $this->json->serialize($this->userManagement->getData());
        $jsonResponseFactory->setData($jsonData);
        return $jsonResponseFactory;
    }
}

