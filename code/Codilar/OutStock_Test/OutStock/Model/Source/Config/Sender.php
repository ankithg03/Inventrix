<?php


namespace Codilar\OutStock\Model\Source\Config;

use Magento\Framework\Option\ArrayInterface;

class Sender implements ArrayInterface
{
    public function toOptionArray()
    {
        return [
            ['label' => __('General Contact'), 'value' => '0'],
            ['label' => __('Sales Representative'), 'value' => '1'],
            ['label' => __('Customer Support'), 'value' => '2'],
            ['label' => __('Custom Email 1'), 'value' => '3'],
            ['label' => __('Custom Email 2'), 'value' => '4']
        ];
    }
}
