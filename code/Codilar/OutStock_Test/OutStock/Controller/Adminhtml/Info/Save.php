<?php
/**
 *   Name - Sanjay Kumar Das
 *   Email - sanjay.d@gmail.com
 *   Author - Sanjay
 */
namespace Codilar\OutStock\Controller\Adminhtml\Info;

use Codilar\OutStock\Api\OutStockRepositoryInterface;
use Magento\Backend\Model\UrlInterface;
use Magento\Framework\App\ActionInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Message\ManagerInterface;



class Save implements ActionInterface
{
    protected $resultFactory;
    private $request;
    private $url;
    private $outstockRepository;
    private $manager;

    /**
     * Save constructor.
     * @param ResultFactory $resultFactory
     * @param RequestInterface $request
     * @param OutStockRepositoryInterface $outstockRepository
     * @param ManagerInterface $manager
     * @param UrlInterface $url
     */
    public function __construct(
        ResultFactory $resultFactory,
        RequestInterface $request,
        OutStockRepositoryInterface $outstockRepository,
        ManagerInterface $manager,
        UrlInterface $url
    ) {
        $this->resultFactory = $resultFactory;
        $this->request = $request;
        $this->url = $url;
        $this->outstockRepository = $outstockRepository;
        $this->manager = $manager;
    }

    public function execute()
    {
        $redirectResponse = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $redirectResponse->setUrl($this->url->getUrl('*/*/index'));
        try{
            $model = $this->outstockRepository->load($this->request->getParam('id'));
            $model->setData($this->request->getParams());
            $this->outstockRepository->save($model);
            $this->manager->addSuccessMessage(
                __(sprintf(
                    'The OutStock %s Information has been saved Successfully',
                    $this->request->getParam('name')
                    )
                )
            );
        } catch (\Exception $exception) {
            $this->manager->addErrorMessage(
                __(sprintf(
                        'The OutStock %s Information has not been saved due to Some Technical Reason',
                        $this->request->getParam('name')
                    )
                )
            );
        }
        return $redirectResponse;
    }
}


