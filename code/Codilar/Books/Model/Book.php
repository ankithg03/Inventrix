<?php


namespace Codilar\Books\Model;


use Magento\Framework\Model\AbstractModel;

class Book extends AbstractModel
{
    protected function _construct()
    {
        $this->_init(ResourceModel\Book::class);
    }
}
