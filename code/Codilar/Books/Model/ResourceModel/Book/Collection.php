<?php


namespace Codilar\Books\Model\ResourceModel\Book;


use Codilar\Books\Model\Book;
use Codilar\Books\Model\ResourceModel\Book as BookResourceModel;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(Book::class, BookResourceModel::class);
    }
}
