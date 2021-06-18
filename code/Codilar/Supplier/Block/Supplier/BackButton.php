<?php

namespace Codilar\Supplier\Block\Supplier;

use Magento\Cms\Block\Adminhtml\Block\Edit\BackButton as MagentoBackButton;

/**
 * class BackButton

 * @description BackButton
 * @author   Codilar Team Player <bhaktahari.p@codilar.com>
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
