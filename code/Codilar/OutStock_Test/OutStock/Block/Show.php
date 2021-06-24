<?php


namespace Codilar\OutStock\Block;


use Codilar\OutStock\Model\ResourceModel\OutStock\Collection;
use Magento\Framework\View\Element\Template;

class Show extends Template
{

    private $collection;


    public function __construct(
        Template\Context $context,
        Collection $collection,
        array $data = []
    )
    {
        $this->collection = $collection;
        parent::__construct($context, $data);
    }


//    public function getAllVendor()
//    {
//        return $this->collection;
//    }


    public function getPostUrl()
    {
        return $this->getUrl('outstock/customer/save');
    }


//  /*  /**
//     * @return string
//     */
//    public function getEditPageUrl()
//    {
//        return $this->getUrl('vendor/vendor/edit');
//    }
//
//    /**
//     * @return string
//     */
//    public function getDeleteUrl()
//    {
//        return $this->getUrl('vendor/vendor/delete');
//    }*/


}
