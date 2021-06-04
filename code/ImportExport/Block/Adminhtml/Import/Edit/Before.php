<?php

namespace Scrumwheel\ImportExport\Block\Adminhtml\Import\Edit;

class Before extends \Magento\Backend\Block\Template
{

    protected $_importModel;

    protected $_jsonEncoder;

    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Json\EncoderInterface $jsonEncoder,
        \Magento\ImportExport\Model\Import $importModel,
        array $data = []
    ) {
        $this->_jsonEncoder = $jsonEncoder;
        $this->_importModel = $importModel;
        parent::__construct($context, $data);
    }


    public function getEntityBehaviors()
    {
        $behaviors = $this->_importModel->getEntityBehaviors();
        foreach ($behaviors as $entityCode => $behavior) {
            $behaviors[$entityCode] = $behavior['code'];
        }
        return $this->_jsonEncoder->encode($behaviors);
    }

    public function getEntityBehaviorsNotes()
    {
        $behaviors = $this->_importModel->getEntityBehaviors();
        foreach ($behaviors as $entityCode => $behavior) {
            $behaviors[$entityCode] = $behavior['notes'];
        }
        return $this->_jsonEncoder->encode($behaviors);
    }

    public function getUniqueBehaviors()
    {
        $uniqueBehaviors = $this->_importModel->getUniqueEntityBehaviors();
        return $this->_jsonEncoder->encode(array_keys($uniqueBehaviors));
    }
}
