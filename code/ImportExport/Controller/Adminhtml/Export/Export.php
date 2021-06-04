<?php
namespace Scrumwheel\ImportExport\Controller\Adminhtml\Export;

use Magento\Catalog\Helper\DefaultCategory;
use Magento\Catalog\Model\Category;
use Magento\Catalog\Model\CategoryFactory;
use Magento\Framework\Filesystem\Driver\File;
use Magento\Catalog\Model\CategoryRepository;
use Magento\Setup\Exception;
use Magento\Store\Model\Store;

class Export extends \Magento\Backend\App\Action
{
    protected $fileSystem;
    protected $uploaderFactory;
    protected $storeManager;
    protected $request;
    protected $_file;
    protected $adapterFactory;
    protected $categoryFactory;
    protected $categoryRepository;
    protected $scopeConfig;
    protected $csvProcessor;
    protected $directoryList;
    protected $fileFactory;
    protected $messageManager;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Filesystem $fileSystem,
        \Magento\Framework\App\RequestInterface $request,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        CategoryFactory $categoryFactory,
        CategoryRepository $categoryRepository,
        File $file,
        \Magento\Framework\App\Response\Http\FileFactory $fileFactory,
        \Magento\Framework\App\Filesystem\DirectoryList $directoryList,
        \Magento\Framework\Message\ManagerInterface $messageManager,
        \Magento\Framework\File\Csv $csvProcessor
    )
    {
        parent::__construct($context);
        $this->fileSystem = $fileSystem;
        $this->request = $request;
        $this->categoryFactory = $categoryFactory;
        $this->categoryRepository = $categoryRepository;
        $this->storeManager = $storeManager;
        $this->fileFactory = $fileFactory;
        $this->scopeConfig = $scopeConfig;
        $this->csvProcessor = $csvProcessor;
        $this->directoryList = $directoryList;
        $this->messageManager = $messageManager;
        $this->_file = $file;
    }

    public function execute()
    {
        $writer = new \Zend\Log\Writer\Stream(BP . '/var/log/scrumwheel_category.log');
        $logger = new \Zend\Log\Logger();
        $logger->addWriter($writer);
        $resultRedirect = $this->resultRedirectFactory->create();
        try {
            $postData = $this->getRequest()->getPostValue();
            if(!isset($postData['store_id']) && empty($postData['store_id'])){
                $store = $this->storeManager->getStore(Store::ADMIN_CODE);
            }else{
                $store = $this->storeManager->getStore($postData['store_id']);
            }

            $this->storeManager->setCurrentStore($store->getCode());

            $fileName = 'Category_'.time().rand(10,99).'.csv';
            $filePath = $this->directoryList->getPath(\Magento\Framework\App\Filesystem\DirectoryList::VAR_DIR)
                . "/" . $fileName;

            $this->csvProcessor
                ->setDelimiter(',')
                ->setEnclosure('"')
                ->saveData(
                    $filePath,
                    $this->getCategoryData()
                );

            return $this->fileFactory->create(
                $fileName,
                [
                    'type' => "filename",
                    'value' => $fileName,
                    'rm' => true,
                ],
                \Magento\Framework\App\Filesystem\DirectoryList::VAR_DIR,
                'application/octet-stream'
            );
        }catch (\Exception $e){
            $logger->info($e->getMessage());
        }
        return $resultRedirect->setPath('scrumwheel/export/index');
    }

    protected function getCategoryData()
    {
        $writer = new \Zend\Log\Writer\Stream(BP . '/var/log/scrumwheel_category.log');
        $logger = new \Zend\Log\Logger();
        $logger->addWriter($writer);

        $result = array();
        $result[] = [
            'category_id',
            'name',
            'store_id',
            'parent',
            'is_active',
            'include_in_menu',
            'description',
            'display_mode',
            'is_anchor',
            'url_key',
            'meta_title',
            'meta_keywords',
            'meta_description',
            'image'
        ];
        $categoryFactory = $this->_objectManager->create('Magento\Catalog\Model\ResourceModel\Category\CollectionFactory');
        $categories = $categoryFactory->create()
            ->addAttributeToSelect('*')
            ->setStore($this->storeManager->getStore());


        foreach ($categories as $category) {
            $result[] = [
                $category->getId(),
                $category->getName(),
                $category->getStoreId(),
                $category->getParentId(),
                $category->getIsActive(),
                $category->getIncludeInMenu(),
                $category->getDescription(),
                $category->getDisplayMode(),
                $category->getIsAnchor(),
                $category->getUrlKey(),
                $category->getMetaTitle(),
                $category->getMetaKeywords(),
                $category->getMetaDescription(),
                $category->getImageUrl()
            ];
        }

        return $result;
    }
}
