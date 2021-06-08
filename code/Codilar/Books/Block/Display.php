<?php

namespace Codilar\Books\Block;

use Codilar\Books\Model\ResourceModel\Book\Collection;
use Magento\Framework\View\Element\Template;

class Display extends Template
{
    /**
     * @var Collection
     */
    private $collection;

    /**
     * Display constructor.
     * @param Template\Context $context
     * @param Collection $collection
     * @param array $data
     */
    public function __construct(
        Template\Context $context,
        Collection $collection,
        array $data = []
    )
    {
        $this->collection = $collection;
        parent::__construct($context, $data);
    }

    /**
     * @return Collection
     */
    public function getAllBooks()
    {
        return $this->collection;
    }
    public function getPostUrl()
    {
        return $this->getUrl('books/book/save');
    }
}
