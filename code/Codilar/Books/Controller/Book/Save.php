<?php

namespace Codilar\Books\Controller\Book;

use Codilar\Books\Model\Book;
use Codilar\Books\Model\ResourceModel\Book as BookResourceModel;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;

class Save extends Action
{
    /**
     * @var book
     */
    private $book;
    /**
     * @var bookResourceModel
     */
    private $bookResourceModel;

    /**
     * Add constructor.
     * @param Context $context
     * @param Book $Book
     * @param BookResourceModel $bookResourceModel
     */
    public function __construct(
        Context $context,
        Book $book,
        BookResourceModel $bookResourceModel
    ) {
        $this->book = $book;
        $this->bookResourceModel = $bookResourceModel;
        parent::__construct($context);
    }

    public function execute()
    {
        $params = $this->getRequest()->getParams();
        $book = $this->book->setData($params);
        try {
            $this->bookResourceModel->save($book);
            $this->messageManager->addSuccessMessage(__("Successfully added the Books %1", $params['name']));
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage(__("Something went wrong."));
        }

        $redirect = $this->resultRedirectFactory->create();
        $redirect->setPath('books');
        return $redirect;
    }
}
