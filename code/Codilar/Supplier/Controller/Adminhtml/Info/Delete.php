<?php

namespace Codilar\Supplier\Controller\Adminhtml\Info;
use Codilar\Supplier\Api\SupplierRepositoryInterface;
use Magento\Backend\Model\UrlInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Message\ManagerInterface;
use Magento\Framework\App\ActionInterface;

/**
 * Class Delete
 *
 * @description A magento 2 module to have Suppliers for products
 * @author  <bhaktahari.p@codilar.com>
 *
 * A magento 2 module to have Suppliers for products
 */

class Delete implements ActionInterface
{
    private $resultFactory;
    private $supplierRepository;
    private $request;
    private $url;
    private $manager;

    /**
     * Index constructor.
     * @param ResultFactory $resultFactory
     * @param RequestInterface $request
     * @param SupplierRepositoryInterface $supplierRepository
     * @param ManagerInterface $manager
     * @param UrlInterface $url
     */

    public function __construct(
        ResultFactory $resultFactory,
        RequestInterface $request,
        SupplierRepositoryInterface $supplierRepository,
        ManagerInterface $manager,
        UrlInterface $url
    ) {
        $this->resultFactory = $resultFactory;
        $this->supplierRepository = $supplierRepository;
        $this->request = $request;
        $this->url = $url;
        $this->manager = $manager;
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $redirectResponse = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $redirectResponse->setUrl($this->url->getUrl('*/*/index'));
        $result = $this->supplierRepository->deleteById($this->request->getParam('id'));
        if($result) {
            $this->manager->addSuccessMessage(
                __(sprintf(
                        'The Supplier with id %s has been deleted Successfully',
                        $this->request->getParam('id')
                    )
                )
            );
        } else {
            $this->manager->addErrorMessage(
                __(sprintf(
                        'The Supplier with id %s has not been deleted, Due to some technical reasons',
                        $this->request->getParam('id')
                    )
                )
            );
        }
        return $redirectResponse;
    }
}
