<?php

namespace Codilar\FAQ\Block\FAQGroup;

use Magento\Cms\Block\Adminhtml\Block\Edit\BackButton as MagentoBackButton;

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
