<?php

namespace Codilar\FAQ\Controller\Adminhtml\Info;

use Codilar\FAQ\Api\FAQRepositoryInterface;
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
    private $faqRepository;
    private $manager;


    /**
     * Save constructor.
     * @param ResultFactory $resultFactory
     * @param RequestInterface $request
     * @param FAQRepositoryInterface $faqRepository
     * @param ManagerInterface $manager
     * @param UrlInterface $url
     */
    public function __construct(
        ResultFactory $resultFactory,
        RequestInterface $request,
        FAQRepositoryInterface $faqRepository,
        ManagerInterface $manager,
        UrlInterface $url
    ) {
        $this->resultFactory = $resultFactory;
        $this->request = $request;
        $this->url = $url;
        $this->faqRepository = $faqRepository;
        $this->manager = $manager;
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $redirectResponse = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $redirectResponse->setUrl($this->url->getUrl('*/*/index'));
        try{
            $model = $this->faqRepository->load($this->request->getParam('id'));
            $model->setData($this->request->getParams());
            $this->faqRepository->save($model);
            $this->manager->addSuccessMessage(
                __(sprintf(
                    'The FAQ %s Information has been saved Successfully',
                    $this->request->getParam('name')
                    )
                )
            );
        } catch (\Exception $exception) {
            $this->manager->addErrorMessage(
                __(sprintf(
                        'The FAQ %s Information has not been saved due to Some Technical Reason',
                        $this->request->getParam('name')
                    )
                )
            );
        }
        return $redirectResponse;
    }
}


