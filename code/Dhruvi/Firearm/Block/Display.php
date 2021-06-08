<?php

namespace Dhruvi\Firearm\Block;

use Dhruvi\Firearm\Model\ResourceModel\Firearm\Collection;
use Magento\Framework\View\Element\Template;

class Display extends Template
{
    
    private $collection;

    public function __construct(
        Template\Context $context,
        Collection $collection,
        array $data = []
    ) {
        $this->collection = $collection;
        parent::__construct($context, $data);
    }

    
    public function getAllFirearms()
    {
        return $this->collection;
    }

    
    public function getPostUrl()
    {
        return $this->getUrl('firearm/firearm/save');
    }

    
}