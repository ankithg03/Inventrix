<?php
namespace Codilar\FAQ\Model\DataProvider\FAQGroup;
use Codilar\FAQ\Model\ResourceModel\FAQGroup\Collection as Collection;
use Codilar\FAQ\Model\ResourceModel\FAQGroup\CollectionFactory as CollectionFactory;
use Magento\Framework\App\RequestInterface;
use Magento\Ui\DataProvider\AbstractDataProvider;

class InfoProvider extends AbstractDataProvider
{
    /**
     * @var
     */
    protected $loadedData;
    /**
     * @var RequestInterface
     */
    private $request;
    /**
     * @var Collection
     */
    private $collectionFactory;
    /**
     * DataProvider constructor.
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param CollectionFactory $collectionFactory
     * @param RequestInterface $request
     * @param array $meta
     * @param array $data
     */
    public function __construct( $name, $primaryFieldName, $requestFieldName, CollectionFactory $collectionFactory, RequestInterface $request, array $meta = [], array $data = [])
    {
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
        $this->collection = $collectionFactory->create();
        $this->request = $request;
        $this->collectionFactory = $collectionFactory;
    }
    /**
     * @return array
     */
    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }
        $id = $this->request->getParam('id');
        $items = $this->collectionFactory->create()->addFieldToFilter('id', $id)->getItems();
        foreach ($items as $item) {
            $faqGroupData = $item->getData();
            $this->loadedData[$item->getId()] = $faqGroupData;
        }
        return $this->loadedData;
    }
}


