<?php
/**
 *   Name - Sanjay Kumar Das
 *   Email - sanjay.d@gmail.com
 *   Author - Sanjay
 */
namespace Codilar\Merchant\Controller\Adminhtml\Info;

use Codilar\Merchant\Api\MerchantRepositoryInterface;
use Magento\Backend\Model\UrlInterface;
use Magento\Framework\App\ActionInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Message\ManagerInterface;

/**
 * Class Save
 *
 * @description A magento 2 module to have Merchants for products
 * @author   <sanjay.d@gmail.com>
 *
 * A magento 2 module to have Merchants for products
 */

class Save implements ActionInterface
{
    protected $resultFactory;
    private $request;
    private $url;
    private $merchantRepository;
    private $manager;

    /**
     * Save constructor.
     * @param ResultFactory $resultFactory
     * @param RequestInterface $request
     * @param MerchantRepositoryInterface $merchantRepository
     * @param ManagerInterface $manager
     * @param UrlInterface $url
     */
    public function __construct(
        ResultFactory $resultFactory,
        RequestInterface $request,
        MerchantRepositoryInterface $merchantRepository,
        ManagerInterface $manager,
        UrlInterface $url
    ) {
        $this->resultFactory = $resultFactory;
        $this->request = $request;
        $this->url = $url;
        $this->merchantRepository = $merchantRepository;
        $this->manager = $manager;
    }

    public function execute()
    {
        $redirectResponse = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $redirectResponse->setUrl($this->url->getUrl('*/*/index'));
        try{
            $model = $this->merchantRepository->load($this->request->getParam('id'));
            $model->setData($this->request->getParams());
            $this->merchantRepository->save($model);
            $this->manager->addSuccessMessage(
                __(sprintf(
                    'The Merchant %s Information has been saved Successfully',
                    $this->request->getParam('name')
                    )
                )
            );
        } catch (\Exception $exception) {
            $this->manager->addErrorMessage(
                __(sprintf(
                        'The Merchant %s Information has not been saved due to Some Technical Reason',
                        $this->request->getParam('name')
                    )
                )
            );
        }
        return $redirectResponse;
    }
}


