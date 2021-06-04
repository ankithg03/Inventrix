<?php
namespace Scrumwheel\ImportExport\Block\Adminhtml\Form;

class After extends \Magento\Backend\Block\Template
{

    protected $_registry;

    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        array $data = []
    ) {
        $this->_registry = $registry;
        parent::__construct($context, $data);
    }

    public function getOperation()
    {
        return $this->_registry->registry('current_operation');
    }
}
