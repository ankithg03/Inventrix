<?php


namespace Codilar\OutStock\Model\Source\Config;
use Magento\Framework\Option\ArrayInterface;

class EmailSuccess implements ArrayInterface
{
    public function toOptionArray()
    {
        return [
            ['label' => __('Email Out of Stock Notification Template(Default)'), 'value' => '0'],
            ['label' => __('New Pickup Order'), 'value' => '1'],
            ['label' => __('New Pickup Order For Guest'), 'value' => '2'],
        ];
    }
}
