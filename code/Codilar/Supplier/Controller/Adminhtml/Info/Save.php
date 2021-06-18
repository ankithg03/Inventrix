<?php

namespace Codilar\Supplier\Controller\Adminhtml\Info;

use Codilar\Supplier\Api\SupplierRepositoryInterface;
use Magento\Backend\Model\UrlInterface;
use Magento\Framework\App\ActionInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Message\ManagerInterface;

/**
 * Class Save
 *
 * @description A magento 2 module to have Suppliers for products
 * @author   <bhaktahari.p@codilar.com>
 *
 * A magento 2 module to have Suppliers for products
 */

class Save implements ActionInterface
{
    protected $resultFactory;
    private $request;
    private $url;
    private $supplierRepository;
    private $manager;

    /**
     * Save constructor.
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
        $this->request = $request;
        $this->url = $url;
        $this->supplierRepository = $supplierRepository;
        $this->manager = $manager;
    }

    public function execute()
    {
        $redirectResponse = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $redirectResponse->setUrl($this->url->getUrl('*/*/index'));
        try{
            $model = $this->supplierRepository->load($this->request->getParam('id'));
            $model->setData($this->request->getParams());
            $this->supplierRepository->save($model);
            $this->manager->addSuccessMessage(
                __(sprintf(
                    'The Supplier %s Information has been saved Successfully',
                    $this->request->getParam('name')
                    )
                )
            );
        } catch (\Exception $exception) {
            $this->manager->addErrorMessage(
                __(sprintf(
                        'The Supplier %s Information has not been saved due to Some Technical Reason',
                        $this->request->getParam('name')
                    )
                )
            );
        }
        return $redirectResponse;
    }
}


