<?php
namespace Scrumwheel\ImportExport\Controller\Adminhtml\Import;

use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Setup\Exception;
use Magento\Store\Model\Store;
use Magento\Catalog\Helper\DefaultCategory;
use Magento\Catalog\Model\CategoryFactory;
use Magento\Framework\Filesystem\Driver\File;
use Magento\Catalog\Model\CategoryRepository;
use Scrumwheel\ImportExport\Helper\Data;
use Magento\Framework\App\PageCache\Version;
use Magento\Framework\App\Cache\TypeListInterface;
use Magento\Framework\App\Cache\Frontend\Pool;

class Validate extends \Magento\Backend\App\Action
{

    protected $fileSystem;

    protected $uploaderFactory;
    protected $storeManager;
    protected $cacheTypeList;
    protected $cacheFrontendPool;
    protected $request;
    protected $_file;
    protected $directoryList;

    protected $adapterFactory;
    private $state;
    protected $defaultCategoryHelper;

    protected $categoryFactory;
    protected $categoryRepository;
    protected $file;
    protected $helper;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Filesystem $fileSystem,
        \Magento\MediaStorage\Model\File\UploaderFactory $uploaderFactory,
        \Magento\Framework\App\RequestInterface $request,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        DefaultCategory $defaultCategoryHelper,
        CategoryFactory $categoryFactory,
        CategoryRepository $categoryRepository,
        DirectoryList $directoryList,
        File $file,
        TypeListInterface $cacheTypeList,
        Pool $cacheFrontendPool,
        \Magento\Framework\Filesystem\Io\File $__file,
        \Scrumwheel\ImportExport\Helper\Data $helper,
        \Magento\Framework\App\State $state
    ) {
        parent::__construct($context);
        $this->fileSystem = $fileSystem;
        $this->request = $request;
        $this->helper = $helper;
        $this->file = $__file;
        $this->directoryList = $directoryList;
        $this->defaultCategoryHelper = $defaultCategoryHelper;
        $this->categoryFactory = $categoryFactory;
        $this->categoryRepository = $categoryRepository;
        $this->state = $state;
        $this->storeManager = $storeManager;
        $this->scopeConfig = $scopeConfig;
        $this->_file = $file;
        $this->cacheTypeList = $cacheTypeList;
        $this->cacheFrontendPool = $cacheFrontendPool;
        $this->uploaderFactory = $uploaderFactory;
    }

    public function execute()
    {
        $post = $this->getRequest()->getPostValue();
        $store = $this->storeManager->getStore(Store::ADMIN_CODE);
        $this->storeManager->setCurrentStore($store->getCode());
        $errorCount = 10;
        $flagCount = 0;
        if(isset($post['allowedErrorCount']) && !empty($post['allowedErrorCount'])){
            $errorCount = $post['allowedErrorCount'];
        }

        $fileData = $this->getRequest()->getFiles('file');
        if ( !isset($fileData['name']) && empty($fileData['name']) )
        {
            $this->messageManager->addError(__("Please Try Again"));
        }
        $arr_file_types = ['text/csv'];
        if (!(in_array($fileData['type'], $arr_file_types))) {
            $this->messageManager->addError(__("Invalid file extension, please use one of: .csv"));
        }

        try{
            $uploaderFactory = $this->uploaderFactory->create(['fileId' => 'file']);
            $uploaderFactory->setAllowedExtensions(['csv']);
            $uploaderFactory->setAllowRenameFiles(true);
            $uploaderFactory->setFilesDispersion(true);
            $mediaDirectory = $this->fileSystem->getDirectoryRead(DirectoryList::MEDIA);
            $destinationPath = $mediaDirectory->getAbsolutePath('tmp');

            $result = $uploaderFactory->save($destinationPath);

            if (!$result)
            {
                throw new LocalizedException
                (
                    __('File cannot be saved to path: $1', $destinationPath)
                );

            }else {
                $imagePath = 'tmp' . $result['file'];
                $mediaDirectory = $this->fileSystem->getDirectoryRead(DirectoryList::MEDIA);
                $destinationfilePath = $mediaDirectory->getAbsolutePath($imagePath);

                $f_object = fopen($destinationfilePath, "r");
                $column = fgetcsv($f_object);
                $flag = 0;
                if($f_object) {
                    if($post['behavior'] == 'update'){
                        if($column[0] != 'category_id') {
                            $this->messageManager->getMessages(true);
                            $this->messageManager->addError(__("category_id is required to update category"));
                            return;
                        }
                    }
                    if($post['behavior'] == 'add'){
                        if($column[0] != 'name'){
                            $this->messageManager->getMessages(true);
                            $this->messageManager->addError(__("name column is required to add category."));
                            return;
                        }
                        if($column[1] != 'store_id'){
                            $this->messageManager->getMessages(true);
                            $this->messageManager->addError(__("store_id column is required to add category."));
                            return;
                        }
                        if($column[2] != 'parent'){
                            $this->messageManager->getMessages(true);
                            $this->messageManager->addError(__("parent column is required to add category."));
                            return;
                        }
                    }

                    $count = 0;
                    $errorKey = "Added.";
                    while (($columns = fgetcsv($f_object)) !== FALSE) {

                        if($post['behavior'] == 'update'){
                                $catName = $columns[1];
                                if(isset($columns[9]) && !empty($columns[9])){
                                    $urlKey = trim(preg_replace('/ +/', '', preg_replace('/[^A-Za-z0-9 ]/', '', urldecode(html_entity_decode(strip_tags($columns[9]))))));
                                }else{
                                    $urlKey = trim(preg_replace('/ +/', '', preg_replace('/[^A-Za-z0-9 ]/', '', urldecode(html_entity_decode(strip_tags($catName))))));
                                }
                                $parentId = $this->defaultCategoryHelper->getId();
                                $parentCategory = $this->categoryFactory->create();
                                $parentCategory = $parentCategory->load($parentId);

                                $row = [
                                    'parent_id'       => $parentCategory->getId(),
                                    'name'            => $catName,
                                    'url_key'         => $urlKey,
                                    'is_active'          => 0,
                                    'is_anchor'       => 0,
                                    'include_in_menu' => 0,
                                    'display_mode'    => 'PRODUCTS',
                                    'description' => '',
                                    'meta_title' => '',
                                    'meta_keywords' => '',
                                    'meta_description' => '',
                                ];
                                if($columns[4] == 1) {
                                    $row['is_active'] = 1;
                                }else{
                                    $row['is_active'] = $columns[4];
                                }
                                if(isset($columns[7]) && !empty($columns[7])) {
                                    $row['display_mode'] = $columns[7];
                                }
                                if($columns[8] == 1) {
                                    $row['is_anchor'] = 1;
                                }else{
                                    $row['is_anchor'] = $columns[8];
                                }
                                if(isset($columns[3]) && !empty($columns[3])) {
                                    $row['parent_id'] = $columns[3];
                                }
                                if($columns[5] == 1) {
                                    $row['include_in_menu'] = 1;
                                }else{
                                    $row['include_in_menu'] = $columns[5];
                                }
                                if(isset($columns[6]) && !empty($columns[6])) {
                                    $row['description'] = $columns[6];
                                }
                                if(isset($columns[10]) && !empty($columns[10])) {
                                    $row['meta_title'] = $columns[10];
                                }
                                if(isset($columns[11]) && !empty($columns[11])) {
                                    $row['meta_keywords'] = $columns[11];
                                }
                                if(isset($columns[12]) && !empty($columns[12])) {
                                    $row['meta_description'] = $columns[12];
                                }
                                if(isset($columns[13]) && !empty($columns[13])) {
                                    $row['image'] = $columns[13];
                                }

                                if(isset($columns[2]) && !empty($columns[2])){
                                    $store = $this->storeManager->getStore($columns[2]);
                                }else{
                                    $store = $this->storeManager->getStore(Store::ADMIN_CODE);
                                }
                                $this->storeManager->setCurrentStore($store->getCode());


                                if(isset($columns[0]) && trim($columns[0]) != '') {
                                    $category = $this->_objectManager->create('Magento\Catalog\Model\CategoryFactory')->create()->setStoreId($store->getId())->load($columns[0]);
                                    if($category->getId() != '') {
                                        $category->setName($row['name']);
                                        if ($columns[4] == 1) {
                                            $category->setIsActive(1);
                                        }else{
                                            $category->setIsActive(0);
                                        }
                                        if (isset($columns[7]) && !empty($columns[7])) {
                                            $category->setData('display_mode', $columns[7]);
                                        }
                                        if ($columns[8] == 1) {
                                            $category->setData('is_anchor', 1);
                                        }else{
                                            $category->setData('is_anchor', 0);
                                        }
                                        if ($columns[5] == 1) {
                                            $category->setData('include_in_menu',1);
                                        }else{
                                            $category->setData('include_in_menu',0);
                                        }
                                        if (isset($columns[9]) && !empty($columns[9])) {
                                            $category->setData('url_key', $columns[9]);
                                        }
                                        if (isset($columns[6]) && !empty($columns[6])) {
                                            $category->setData('description', $columns[6]);
                                        }
                                        if (isset($columns[10]) && !empty($columns[10])) {
                                            $category->setData('meta_title', $columns[10]);
                                        }
                                        if (isset($columns[11]) && !empty($columns[11])) {
                                            $category->setData('meta_keywords', $columns[11]);
                                        }
                                        if (isset($columns[12]) && !empty($columns[12])) {
                                            $category->setData('meta_description', $columns[12]);
                                        }
                                        $category->save();
                                        if (isset($columns[3]) && !empty($columns[3])) {
                                            $category->move($columns[3], null);
                                            $category->save();
                                        }
                                        if(!empty($row['image'])) {
                                            $categoryImg = $this->_objectManager->get('Magento\Catalog\Model\Category')->load($category->getId());
                                            $this->uploadImage($categoryImg, $row['image']);
                                        }
                                        $count++;
                                        $flag = 1;
                                    }else{
                                        $this->messageManager->addError(__('Category Id is invalid. '));
                                        if($flagCount >= $errorCount) {
                                            return;
                                        }else{
                                            $flagCount++;
                                            continue;
                                        }
                                    }
                                }else{
                                    $this->messageManager->addError(__('Category Id is required. '));
                                    if($flagCount >= $errorCount) {
                                        return;
                                    }else{
                                        $flagCount++;
                                        continue;
                                    }
                                }
                                $errorKey = "Updated.";
                            }elseif($post['behavior'] == 'delete'){

                                $catName = $columns[1];
                                if(isset($columns[9]) && !empty($columns[9])){
                                    $urlKey = trim(preg_replace('/ +/', '', preg_replace('/[^A-Za-z0-9 ]/', '', urldecode(html_entity_decode(strip_tags($columns[9]))))));
                                }else{
                                    $urlKey = trim(preg_replace('/ +/', '', preg_replace('/[^A-Za-z0-9 ]/', '', urldecode(html_entity_decode(strip_tags($catName))))));
                                }
                                $parentId = $this->defaultCategoryHelper->getId();
                                $parentCategory = $this->categoryFactory->create();
                                $parentCategory = $parentCategory->load($parentId);

                                $row = [
                                    'parent_id'       => $parentCategory->getId(),
                                    'name'            => $catName,
                                    'url_key'         => $urlKey,
                                    'is_active'          => 0,
                                    'is_anchor'       => 0,
                                    'include_in_menu' => 0,
                                    'display_mode'    => 'PRODUCTS',
                                    'description' => '',
                                    'meta_title' => '',
                                    'meta_keywords' => '',
                                    'meta_description' => '',
                                ];
                                if(isset($columns[4]) && !empty($columns[4])) {
                                    $row['is_active'] = $columns[4];
                                }
                                if(isset($columns[7]) && !empty($columns[7])) {
                                    $row['display_mode'] = $columns[7];
                                }
                                if(isset($columns[8]) && !empty($columns[8])) {
                                    $row['is_anchor'] = $columns[8];
                                }
                                if(isset($columns[3]) && !empty($columns[3])) {
                                    $row['parent_id'] = $columns[3];
                                }
                                if(isset($columns[5]) && !empty($columns[5])) {
                                    $row['include_in_menu'] = $columns[5];
                                }
                                if(isset($columns[6]) && !empty($columns[6])) {
                                    $row['description'] = $columns[6];
                                }
                                if(isset($columns[10]) && !empty($columns[10])) {
                                    $row['meta_title'] = $columns[10];
                                }
                                if(isset($columns[11]) && !empty($columns[11])) {
                                    $row['meta_keywords'] = $columns[11];
                                }
                                if(isset($columns[12]) && !empty($columns[12])) {
                                    $row['meta_description'] = $columns[12];
                                }
                                if(isset($columns[13]) && !empty($columns[13])) {
                                    $row['image'] = $columns[13];
                                }

                                if(isset($columns[2]) && !empty($columns[2])){
                                    $store = $this->storeManager->getStore($columns[2]);
                                }else{
                                    $store = $this->storeManager->getStore(Store::ADMIN_CODE);
                                }
                                $this->storeManager->setCurrentStore($store->getCode());


                                if(isset($columns[0]) && trim($columns[0]) != '') {
                                    $cat = $this->categoryFactory->create();
                                    $category = $cat->loadByAttribute('entity_id', $columns[0]);
                                    if($category) {
                                        $category->delete();
                                        $flag = 1;
                                    }else{
                                        $this->messageManager->getMessages(true);
                                        $this->messageManager->addError(__("Category id is invalid"));
                                        if($flagCount >= $errorCount) {
                                            return;
                                        }else{
                                            $flagCount++;
                                            continue;
                                        }
                                    }
                                    $count++;
                                }else{
                                    $this->messageManager->addError(__('Category Id is required. ' , $count));
                                    if($flagCount >= $errorCount) {
                                        return;
                                    }else{
                                        $flagCount++;
                                        continue;
                                    }
                                }
                                $errorKey = "Deleted.";
                            }else{
                                $catName = $columns[0];
                                if(isset($columns[8]) && !empty($columns[8])){
                                    $urlKey = trim(preg_replace('/ +/', '', preg_replace('/[^A-Za-z0-9 ]/', '', urldecode(html_entity_decode(strip_tags($columns[8]))))));
                                }else{
                                    $urlKey = trim(preg_replace('/ +/', '', preg_replace('/[^A-Za-z0-9 ]/', '', urldecode(html_entity_decode(strip_tags($catName))))));
                                }
                                $parentId = $this->defaultCategoryHelper->getId();
                                $parentCategory = $this->categoryFactory->create();
                                $parentCategory = $parentCategory->load($parentId);

                                $row = [
                                    'parent_id'       => 1,
                                    'name'            => $catName,
                                    'url_key'         => $urlKey,
                                    'is_active'          => 0,
                                    'is_anchor'       => 0,
                                    'include_in_menu' => 0,
                                    'display_mode'    => 'PRODUCTS',
                                    'description' => '',
                                    'meta_title' => '',
                                    'meta_keywords' => '',
                                    'meta_description' => '',
                                ];
                                if(isset($columns[3]) && !empty($columns[3])) {
                                    $row['is_active'] = $columns[3];
                                }
                                if(isset($columns[6]) && !empty($columns[6])) {
                                    $row['display_mode'] = $columns[6];
                                }
                                if(isset($columns[7]) && !empty($columns[7])) {
                                    $row['is_anchor'] = $columns[7];
                                }
                                if(isset($columns[2]) && !empty($columns[2])) {
                                    $row['parent_id'] = $columns[2];
                                }
                                if(isset($columns[4]) && !empty($columns[4])) {
                                    $row['include_in_menu'] = $columns[4];
                                }
                                if(isset($columns[5]) && !empty($columns[5])) {
                                    $row['description'] = $columns[5];
                                }
                                if(isset($columns[9]) && !empty($columns[9])) {
                                    $row['meta_title'] = $columns[9];
                                }
                                if(isset($columns[10]) && !empty($columns[10])) {
                                    $row['meta_keywords'] = $columns[10];
                                }
                                if(isset($columns[11]) && !empty($columns[11])) {
                                    $row['meta_description'] = $columns[11];
                                }
                                if(isset($columns[12]) && !empty($columns[12])) {
                                    $row['image'] = $columns[12];
                                }

                                if(isset($columns[1]) && !empty($columns[1])){
                                    $store = $this->storeManager->getStore($columns[1]);
                                }else{
                                    $store = $this->storeManager->getStore(Store::ADMIN_CODE);
                                }
                                $this->storeManager->setCurrentStore($store->getCode());
                                try {
                                    $category = $this->categoryFactory->create();
                                    $category = $category->loadByAttribute('url_key', $urlKey);
                                    if (!$category) {
                                        $category = $this->categoryFactory->create()->setStoreId($store->getId());
                                        $category
                                            ->setData($row)
                                            ->setAttributeSetId($category->getDefaultAttributeSetId());
                                        $this->setAdditionalData($row, $category);
                                        $this->categoryRepository->save($category);
                                        if (!empty($row['image'])) {
                                            $categoryImg = $this->_objectManager->get('Magento\Catalog\Model\Category')->load($category->getId());
                                            $this->uploadImage($categoryImg, $row['image']);
                                        }
                                        $count++;
                                    } else {
                                        $this->messageManager->addError(__('Category Url key already exist. ', $count));
                                        if ($flagCount >= $errorCount) {
                                            return;
                                        } else {
                                            $flagCount++;
                                            continue;
                                        }
                                    }
                                }catch (\Exception $e){
                                    $this->messageManager->addError(__($e->getMessage()));
                                    if ($flagCount >= $errorCount) {
                                        return;
                                    } else {
                                        $flagCount++;
                                        continue;
                                    }
                                }
                                $flag = 1;
                            }
                    }
                    if($flag == 1) {
                        $this->messageManager->addSuccess(__('A total of %1 record(s) have been ' . $errorKey, $count));
                    }

                }else{
                    $this->messageManager->getMessages(true);
                    $this->messageManager->addError(__("File has been empty"));
                }

            }

        }catch(Exception $e){
            $this->messageManager->addError(__($e->getMessage()));
        }
    }

    protected function setAdditionalData($row, $category)
    {
        $additionalAttributes = [
            'position',
            'display_mode',
            'page_layout',
            'custom_layout_update',
        ];
        foreach ($additionalAttributes as $categoryAttribute) {
            if (!empty($row[$categoryAttribute])) {
                $attributeData = [$categoryAttribute => $row[$categoryAttribute]];
                $category->addData($attributeData);
            }
        }
    }

    protected function uploadImage($category, $imageUrl)
    {
        try {
            if (filter_var($imageUrl, FILTER_VALIDATE_URL) === FALSE) {
                $fileName = $imageUrl;
            } else {
                $tmpDir = $this->getMediaDirTmpDir();
                $this->file->checkAndCreateFolder($tmpDir);
                $fileName = rand(100000, 9999999). '_' . time() . '.png';
                $newFileName = $tmpDir . $fileName;
                $result = $this->file->read($imageUrl, $newFileName);
            }
            $categoryobj = $this->_objectManager->get('Magento\Catalog\Model\Category')->load($category->getId());
            $mediaAttribute = array('image', 'small_image', 'thumbnail');
            $categoryobj->setImage($fileName, $mediaAttribute, true, false);
            $categoryobj->setStoreId(0);
            $categoryobj->save();
        }catch (\Exception $e){
            return false;
        }
        return true;
    }

    protected function getMediaDirTmpDir()
    {
        return $this->directoryList->getPath(DirectoryList::MEDIA) . DIRECTORY_SEPARATOR . 'catalog' . DIRECTORY_SEPARATOR.'category' . DIRECTORY_SEPARATOR;
    }
}
