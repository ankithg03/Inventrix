<?php


namespace Scrumwheel\ImportExport\Helper;

use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Setup\Exception;
use Magento\Store\Model\Store;
use Magento\Catalog\Helper\DefaultCategory;
use Magento\Catalog\Model\CategoryFactory;
use Magento\Framework\Filesystem\Driver\File;
use Magento\Catalog\Model\CategoryRepository;

class Data  extends \Magento\Framework\App\Helper\AbstractHelper
{
    protected $fileSystem;

    protected $uploaderFactory;
    protected $storeManager;

    protected $request;
    protected $_file;
    protected $directoryList;

    protected $adapterFactory;
    private $state;
    protected $defaultCategoryHelper;

    protected $categoryFactory;
    protected $categoryRepository;
    protected $file;

    public function __construct(
        \Magento\Framework\App\Helper\Context $context,
        \Magento\Framework\App\RequestInterface $request,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        DefaultCategory $defaultCategoryHelper,
        CategoryFactory $categoryFactory,
        CategoryRepository $categoryRepository,
        DirectoryList $directoryList,
        File $file,
        \Magento\Framework\Filesystem\Io\File $__file
    ) {
        parent::__construct($context);
        $this->request = $request;
        $this->file = $__file;
        $this->directoryList = $directoryList;
        $this->defaultCategoryHelper = $defaultCategoryHelper;
        $this->categoryFactory = $categoryFactory;
        $this->categoryRepository = $categoryRepository;
        $this->storeManager = $storeManager;
        $this->scopeConfig = $scopeConfig;
        $this->_file = $file;
    }

    public function deleteProductFromCategory($categoryId){
        $category = $this->categoryFactory->create()->load($categoryId);
        $categoryProducts = $category->getProductCollection()->addAttributeToSelect('*');
        if ($categoryProducts) {
            foreach ($categoryProducts as $product) {
                $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
                $categoryLinkRepository = $objectManager->get('\Magento\Catalog\Model\CategoryLinkRepository');
                $categoryLinkRepository->deleteByIds($category->getId(), $product->getSku());
            }
        }
    }
}