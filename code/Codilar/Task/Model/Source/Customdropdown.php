<?php
namespace Codilar\Task\Model\Source;

class Customdropdown extends \Magento\Eav\Model\Entity\Attribute\Source\AbstractSource 
{
    public function getAllOptions() {
        if ($this->_options === null) {
            $this->_options = [
                ['label' => __('--Select--'), 'value' => ''],
                ['label' => __('Yes'), 'value' => 'yes'],
                ['label' => __('No'), 'value' => 'no']
            ];
        }
        return $this->_options;
    }
}
