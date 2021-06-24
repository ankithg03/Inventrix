<?php
/**
 *   Name - Sanjay Kumar Das
 *   Email - sanjay.d@gmail.com
 *   Author - Sanjay
 */
namespace Codilar\OutStock\Block\OutStock;

use Magento\Cms\Block\Adminhtml\Block\Edit\BackButton as MagentoBackButton;

/**
 * class BackButton

 * @description BackButton
 * @author   Codilar Team Player <sanjay.d@codilar.com>
 *
 * Provides Method for going back from the Current Page
 */

class BackButton extends MagentoBackButton
{
    /**
     * Get URL for back (reset) button
     *
     * @return string
     */
    public function getBackUrl()
    {
        return $this->getUrl('*/*/index');
    }
}
