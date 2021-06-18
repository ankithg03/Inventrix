<?php

namespace Codilar\Supplier\Block;

use Codilar\Supplier\Api\SupplierRepositoryInterface;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Catalog\Block\Product\Context;

class Supplier extends \Magento\Catalog\Block\Product\View
{

    /**
     * @var SupplierRepositoryInterface
     */
    private $SupplierRepository;

    /**
     * Supplier constructor.
     * @param Context $context
     * @param \Magento\Framework\Url\EncoderInterface $urlEncoder
     * @param \Magento\Framework\Json\EncoderInterface $jsonEncoder
     * @param \Magento\Framework\Stdlib\StringUtils $string
     * @param \Magento\Catalog\Helper\Product $productHelper
     * @param \Magento\Catalog\Model\ProductTypes\ConfigInterface $productTypeConfig
     * @param \Magento\Framework\Locale\FormatInterface $localeFormat
     * @param \Magento\Customer\Model\Session $customerSession
     * @param ProductRepositoryInterface $productRepository
     * @param \Magento\Framework\Pricing\PriceCurrencyInterface $priceCurrency
     * @param SupplierRepositoryInterface $supplierRepository
     * @param array $data
     */
    public function __construct(
        Context $context,
        \Magento\Framework\Url\EncoderInterface $urlEncoder,
        \Magento\Framework\Json\EncoderInterface $jsonEncoder,
        \Magento\Framework\Stdlib\StringUtils $string,
        \Magento\Catalog\Helper\Product $productHelper,
        \Magento\Catalog\Model\ProductTypes\ConfigInterface $productTypeConfig,
        \Magento\Framework\Locale\FormatInterface $localeFormat,
        \Magento\Customer\Model\Session $customerSession,
        ProductRepositoryInterface $productRepository,
        \Magento\Framework\Pricing\PriceCurrencyInterface $priceCurrency,
        SupplierRepositoryInterface $supplierRepository,
        array $data = [])
    {
        parent::__construct($context, $urlEncoder, $jsonEncoder, $string, $productHelper, $productTypeConfig, $localeFormat, $customerSession, $productRepository, $priceCurrency, $data);
        $this->supplierRepository = $supplierRepository;
    }
    
    public function getSupplierName()
    {
        $supplierAttribute= $this->getProduct()->getCustomAttribute('supplier');
        
        if($supplierAttribute) {
            $collection=$this->supplierRepository->getCollection();
            $collection->addFieldToFilter('is_enable',1);
            $supplierId=$supplierAttribute->getValue();
        
            if(isset($supplierId)){
                $collection->addFieldToFilter('id',$supplierId);
                $supplierInfo=$collection->getFirstItem()->getData();
                return isset($supplierInfo['name']) ? $supplierInfo['name']:false;     
            }
        }
        return false;
    }
    
}