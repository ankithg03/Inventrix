<?php

namespace Codilar\OutStock\Model\Source\Config;

use Magento\Framework\Option\ArrayInterface;

class Option implements ArrayInterface
{
    public function toOptionArray()
    {
        return [
            ['label' => __(''), 'value' => ''],
            ['label' => __('NOT LOGGED IN'), 'value' => '0'],
            ['label' => __('General'), 'value' => '1'],
            ['label' => __('Wholesale'), 'value' => '2'],
            ['label' => __('Retailer'), 'value' => '3']
        ];
    }
}
