<?php
namespace Scrumwheel\ImportExport\Block\Adminhtml\Export;

class Edit extends \Magento\Backend\Block\Widget\Form\Container
{

    protected function _construct()
    {
        parent::_construct();

        $this->buttonList->remove('back');
        $this->buttonList->remove('reset');
        $this->buttonList->update('save', 'label', __('Export'));

        $this->_objectId = 'import_id';
        $this->_blockGroup = 'Scrumwheel_ImportExport';
        $this->_controller = 'adminhtml_export';
    }

    public function getHeaderText()
    {
        return __('Export');
    }
}
