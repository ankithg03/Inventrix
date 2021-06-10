<?php



namespace Codilar\User\Block;

use Codilar\User\Model\UserManagement;
use Codilar\User\Model\ResourceModel\Work\Collection;
use Codilar\User\Model\ResourceModel\Work\CollectionFactory;
use Magento\Framework\View\Element\Template;

class Display extends Template
{
    private $collection;
    /**
     * @var CollectionFactory
     */
    private $collectionFactory;
    /**
     * @var UserManagement
     */
    private $userManagement;

    /**
     * Display constructor.
     * @param Template\Context $context
     * @param UserManagement $userManagement
     * @param array $data
     */
    public function __construct(
        Template\Context $context,
        UserManagement $userManagement,
        array $data = []
    )
    {
        parent::__construct($context, $data);
        $this->userManagement = $userManagement;
    }

    /**
     * @return array
     */
    public function getAllUsers()
    {
        $data = $this->userManagement->getData();
        $writer = new \Zend\Log\Writer\Stream(BP . '/var/log/test.log');
        $logger = new \Zend\Log\Logger();
        $logger->addWriter($writer);
        $logger->info(json_encode($data));
        return $data;
    }

    /**
     * @return string
     */
    public function getPostUrl()
    {
        return $this->getUrl('user/details/save');
    }

    public function getDeleteUrl()
    {
        return $this->getUrl('user/details/delete');
    }
}
