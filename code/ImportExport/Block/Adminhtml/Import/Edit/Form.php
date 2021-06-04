<?php

namespace Scrumwheel\ImportExport\Block\Adminhtml\Import\Edit;

use Magento\ImportExport\Model\Import;
use Magento\ImportExport\Model\Import\ErrorProcessing\ProcessingErrorAggregatorInterface;

class Form extends \Magento\Backend\Block\Widget\Form\Generic
{

    protected $_importModel;

    protected $_entityFactory;

    protected $_behaviorFactory;

    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Magento\ImportExport\Model\Import $importModel,
        \Magento\ImportExport\Model\Source\Import\EntityFactory $entityFactory,
        \Magento\ImportExport\Model\Source\Import\Behavior\Factory $behaviorFactory,
        array $data = []
    ) {
        $this->_entityFactory = $entityFactory;
        $this->_behaviorFactory = $behaviorFactory;
        parent::__construct($context, $registry, $formFactory, $data);
        $this->_importModel = $importModel;
    }

    protected function _prepareForm()
    {
        $form = $this->_formFactory->create(
            [
                'data' => [
                    'id' => 'edit_form',
                    'action' => $this->getUrl('scrumwheel/*/validate'),
                    'method' => 'post',
                    'enctype' => 'multipart/form-data',
                ],
            ]
        );

        $fieldsets['base'] = $form->addFieldset('base_fieldset', ['legend' => __('Import Settings')]);

        $fieldsets['base']->addField(
            'entity',
            'select',
            [
                'name' => 'entity',
                'title' => __('Entity Type'),
                'label' => __('Entity Type'),
                'required' => true,
                'class' => 'validate-select',
                'onchange' => 'varienImport.handleEntityTypeSelector();',
                'values' =>
                    array(
                        '' => '-- Please Select --','catalog_category' => 'Categories'

                ),
                'after_element_html' => $this->getDownloadSampleFileHtml(),
            ]
        );

        $fieldsets['upload'] = $form->addFieldset(
            'upload_file_fieldset',
            ['legend' => __('File to Import')]
        );

        $fieldsets['upload']->addField(
            'behavior',
            'select',
            [
                'name' => 'behavior',
                'title' => __('Import behavior'),
                'label' => __('Import behavior'),
                'required' => true,
                'class' => 'validate-select',
                'values' =>
                    array(
                        'add' => 'Add','update' => 'Update','delete' => 'Delete'

                    ),
            ]
        );

        $fieldsets['upload']->addField(
            'allowedErrorCount',
            'text',
            [
                'name' => 'allowedErrorCount',
                'title' => __('Allowed Error Count'),
                'label' => __('Allowed Error Count'),
                'required' => true,
                'class' => 'validate-number',
                'value' => '10',
            ]
        );

        $fieldsets['upload']->addField(
            \Magento\ImportExport\Model\Import::FIELD_NAME_SOURCE_FILE,
            'file',
            [
                'name' => \Magento\ImportExport\Model\Import::FIELD_NAME_SOURCE_FILE,
                'label' => __('Select File to Import'),
                'title' => __('Select File to Import'),
                'required' => true,
                'class' => 'input-file required-file',
                'accept' => '.csv'
            ]
        );

        $form->setUseContainer(true);
        $this->setForm($form);

        return parent::_prepareForm();
    }

    protected function getDownloadSampleFileHtml()
    {
        $html = '<span id="sample-file-span"  class="no-display"><a id="sample-file-link" href="#">'
            . __('Download Sample File')
            . '</a></span>';
        return $html;
    }
}
