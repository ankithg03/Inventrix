<?php
namespace Codilar\Demo\Model\Source;

class Customdropdown extends \Magento\Eav\Model\Entity\Attribute\Source\AbstractSource
{
    public function getAllOptions() {
        if ($this->_options === null) {
            $this->_options = [
                ['label' => __('--Select--'), 'value' => ''],
                ['label' => __('Best-Sellers'), 'value' => 'bestsellers'],
                ['label' => __('Hot-Deals'), 'value' => 'hot deals'],
                ['label' => __('Featured'), 'value' => 'featured']
            ];
        }
        return $this->_options;
    }
}
