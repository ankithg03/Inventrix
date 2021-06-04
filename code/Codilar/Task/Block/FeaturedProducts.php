<?php
/**
 *
 * @package     magento236
 * @author      Bhaktahari
 * @license     https://opensource.org/licenses/OSL-3.0 Open Software License v. 3.0 (OSL-3.0)
 * @link        https://www.codilar.com/
 */

namespace Codilar\Task\Block;
/**
 * Class FeaturedProducts
 * @package Codilar\Task\Block
 */
class FeaturedProducts extends AbstractSlider
{
    /**
     * get collection of feature products
     * @return mixed
     */
    public function getProductCollection()
    {
        $visibleProducts = $this->_catalogProductVisibility->getVisibleInCatalogIds();
        $collection = $this->_productCollectionFactory->create()->setVisibility($visibleProducts);
        $collection->addMinimalPrice()
            ->addFinalPrice()
            ->addTaxPercents()
            ->addAttributeToSelect('*')
            ->addStoreFilter($this->getStoreId())
            ->setPageSize($this->getProductsCount())
            ->addAttributeToFilter('is_featured', '1');
        return $collection;
    }
}