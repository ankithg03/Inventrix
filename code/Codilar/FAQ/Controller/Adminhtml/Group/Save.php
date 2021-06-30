<?php

namespace Codilar\FAQ\Controller\Adminhtml\Group;

use Codilar\FAQ\Api\FAQGroupRepositoryInterface;
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
    private $faqGroupRepository;
    private $manager;


    /**
     * Save constructor.
     * @param ResultFactory $resultFactory
     * @param RequestInterface $request
     * @param FAQGroupRepositoryInterface $faqGroupRepository
     * @param ManagerInterface $manager
     * @param UrlInterface $url
     */
    public function __construct(
        ResultFactory $resultFactory,
        RequestInterface $request,
        FAQGroupRepositoryInterface $faqGroupRepository,
        ManagerInterface $manager,
        UrlInterface $url
    ) {
        $this->resultFactory = $resultFactory;
        $this->request = $request;
        $this->url = $url;
        $this->faqGroupRepository = $faqGroupRepository;
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
            $model = $this->faqGroupRepository->load($this->request->getParam('id'));
            $model->setData($this->request->getParams());
            $this->faqGroupRepository->save($model);
            $this->manager->addSuccessMessage(
                __(sprintf(
                    'The FAQGroup %s Information has been saved Successfully',
                    $this->request->getParam('name')
                    )
                )
            );
        } catch (\Exception $exception) {
            $this->manager->addErrorMessage(
                __(sprintf(
                        'The FAQGroup %s Information has not been saved due to Some Technical Reason',
                        $this->request->getParam('name')
                    )
                )
            );
        }
        return $redirectResponse;
    }
}
