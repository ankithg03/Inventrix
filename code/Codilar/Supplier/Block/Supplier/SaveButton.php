<?php

namespace Codilar\Supplier\Block\Supplier;

use Magento\CatalogRule\Block\Adminhtml\Edit\GenericButton;
use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

/**
 * class Save
 * @description BackButton
 * @author   <bhaktahari.p@codilar.com>
 * Provides Frontend Data for Save Button like href,label,class and etc.,
 */

class SaveButton extends GenericButton implements ButtonProviderInterface
{
    /**
     * Retrieve button-specified settings
     *
     * @return array
     */
    public function getButtonData()
    {
        return [
            'label' => __('Save'),
            'class' => 'save primary',
            'data_attribute' => [
                'mage-init' => [
                    'buttonAdapter' => [
                        'actions' => [
                            [
                                'targetName' => 'template_add_ui.template_add_ui',
                                'params' => [
                                    false
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ];
    }
}
