<?php
namespace Codilar\FAQ\Controller\Adminhtml\Group;
use Codilar\FAQ\Api\FAQGroupRepositoryInterface;
use Magento\Backend\Model\UrlInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Message\ManagerInterface;
use Magento\Framework\App\ActionInterface;

class Delete implements ActionInterface
{
    /**
     * @var ResultFactory
     */
    private $resultFactory;
    /**
     * @var FAQGroupRepositoryInterface
     */
    private $faqGroupRepository;
    /**
     * @var RequestInterface
     */
    private $request;
    /**
     * @var UrlInterface
     */
    private $url;
    /**
     * @var ManagerInterface
     */
    private $manager;

    /**
     * Index constructor.
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
        $this->faqGroupRepository = $faqGroupRepository;
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
        $result = $this->faqGroupRepository->deleteById($this->request->getParam('id'));
        if($result) {
            $this->manager->addSuccessMessage(
                __(sprintf(
                        'The FAQ with id %s has been deleted Successfully',
                        $this->request->getParam('id')
                    )
                )
            );
        } else {
            $this->manager->addErrorMessage(
                __(sprintf(
                        'The FAQ with id %s has not been deleted, Due to some technical reasons',
                        $this->request->getParam('id')
                    )
                )
            );
        }
        return $redirectResponse;
    }
}
