<?php
namespace Scrumwheel\ImportExport\Block\Adminhtml\Import;

class Edit extends \Magento\Backend\Block\Widget\Form\Container
{

    protected function _construct()
    {
        parent::_construct();

        $this->buttonList->remove('back');
        $this->buttonList->remove('reset');
        $this->buttonList->update('save', 'label', __('Import'));
        $this->buttonList->update('save', 'id', 'upload_button');
        $this->buttonList->update('save', 'onclick', 'varienImport.postToFrame();');
        $this->buttonList->update('save', 'data_attribute', '');

        $this->_objectId = 'import_id';
        $this->_blockGroup = 'Scrumwheel_ImportExport';
        $this->_controller = 'adminhtml_import';
    }

    public function getHeaderText()
    {
        return __('Import');
    }
}
