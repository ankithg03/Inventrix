<?php
namespace Codilar\Movie\Controller\Add;

use Codilar\Movie\Model\MovieManagement;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultFactory;

class Save extends Action
{


    /**
     * @var MovieManagement
     */
    private  $movieManagement;

    /**
     * Save constructor.
     * @param Context $context
     * @param MovieManagement $movieManagement
     */
      public  function  __construct(
          Context $context,
          MovieManagement $movieManagement
      )
      {
          parent::__construct($context);
          $this->$movieManagement = $movieManagement;
      }

    public function execute()
    {
        $resultRedirect = $this->resultFactory->create(type: ResultFactory::TYPE_REDIRECT);

         $name = $this->_request->getParam(key: 'name');
         $price = $this->_request->getParam(key: 'description');
         $company = $this->_request->getParam(key: 'rating');

        $saveResult =false;

        /**
         * Checking The Data Is Coming Or Not If Comes then It Is Empty Or Not
         */
         if (isset($name) && isset($description) && isset($rating) && !empty($name) && !empty($description) && !empty($rating))
         {
             $saveResult  = $this->movieManagement->save($name,$description,$rating);
         }


         if ($saveResult)
         {
                $this->messageManager->addSuccessMessage(message: 'Movie Data Is Added ');
         }
         else
         {
             $this->messageManager->addErrorMessage('Movie Data is Not Added ');
         }

        $resultRedirect->setUrl($this->_url->getUrl(routePath: 'movie/index/index'));
        return $resultRedirect;
    }
}

