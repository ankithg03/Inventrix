<?php

namespace Codilar\OutStock\Block;

use Codilar\OutStock\Api\OutStockRepositoryInterface;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Catalog\Block\Product\Context;
use Codilar\OutStock\Model\Config\ModuleConfiguration;

class Config extends \Magento\Catalog\Block\Product\View
{
    /**
     * @var ModuleConfiguration
     */
    private $moduleConfiguration;
    /**
     * @var OutStockRepositoryInterface
     */
    private $outStockRepository;

    /**
     * Zipcode constructor.
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
     * @param OutStockRepositoryInterface $outStockRepository
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
        OutStockRepositoryInterface $outStockRepository,
        ModuleConfiguration $moduleConfiguration,
        array $data = [])
    {
        parent::__construct($context, $urlEncoder, $jsonEncoder, $string, $productHelper, $productTypeConfig, $localeFormat, $customerSession, $productRepository, $priceCurrency, $data);
        $this->outStockRepository = $outStockRepository;
        $this->moduleConfiguration = $moduleConfiguration;
    }



    /**
     * @return bool
     */
    public function isModuleEnabled()
    {
        return $this->moduleConfiguration->getModuleStatus();
    }

    /**
     * @return string
     */
    public function getCustomerGroup(): string
    {
        return $this->moduleConfiguration->getCustomerGroup();
    }

    public function getEmailSender(): string
    {
        return $this->moduleConfiguration->getEmailSender();
    }

    public function getPopHeading(): string
    {
        return $this->moduleConfiguration->getPopHeading();
    }

    public function getPopDes(): string
    {
        return $this->moduleConfiguration->getPopDes();
    }

    public function getPOPEmail(): string
    {
        return $this->moduleConfiguration->getPOPEmail();
    }

    public function getPopButton(): string
    {
        return $this->moduleConfiguration->getPopButton();
    }

    public function getPopFooter(): string
    {
        return $this->moduleConfiguration->getPopFooter();
    }
    public function getPostUrl()
    {
        return $this->getUrl('outstock/customer/save');
    }

}

