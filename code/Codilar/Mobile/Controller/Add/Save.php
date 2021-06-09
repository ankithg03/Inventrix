<?php
namespace Codilar\Mobile\Controller\Add;

use Codilar\Mobile\Model\MobileManagement;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultFactory;

class Save extends Action
{


    /**
     * @var MobileManagement
     */
    private  $mobileManagement;

    /**
     * Save constructor.
     * @param Context $context
     * @param MobileManagement $mobileManagement
     */
      public  function  __construct(
          Context $context,
          MobileManagement $mobileManagement
      )


      {
          parent::__construct($context);
          $this->$mobileManagement = $mobileManagement;
      }

    public function execute()
    {
        $resultRedirect = $this->resultFactory->create(type: ResultFactory::TYPE_REDIRECT);

         $name = $this->_request->getParam(key: 'name');
         $price = $this->_request->getParam(key: 'price');
         $company = $this->_request->getParam(key: 'company');

        $saveResult =false;

        /**
         * Checking The Data Is Coming Or Not If Comes then It Is Empty Or Not
         */
         if (isset($name) && isset($price) && isset($company) && !empty($name) && !empty($price) && !empty($company))
         {
             $saveResult  = $this->mobileManagement->save($name,$price,$company);
         }


         if ($saveResult)
         {
                $this->messageManager->addSuccessMessage(message: 'Mobile Data Is Added ');
         }
         else
         {
             $this->messageManager->addErrorMessage('Mobile Data is Not Added ');
         }

        $resultRedirect->setUrl($this->_url->getUrl(routePath: 'mobile/index/index'));
        return $resultRedirect;
    }
}

