<?php

namespace  Codilar\Mobile\Model;

use Codilar\Mobile\Model\MobileFactory as ModelFactory;
use Codilar\Mobile\Model\Mobile as Model;

use Codilar\Mobile\Model\ResourceModel\Mobile as ResourceModel;

class  MobileManagement
{


    /**
     * @var Codilar\Mobile\Model\MobileFactory
     */
    private $mobileFactory;


    /**
     * @var ResourceModel
     */
    private $resourceModel;


    /**
     * MobileManagement constructor.
     * @param MobileFactory $modelfactory
     * @param ResourceModel $resourceModel
     */
       public  function __construct(

           ModelFactory $modelfactory,
           ResourceModel $resourceModel
      )
      {
          $this->modelfactory  =  $modelfactory;
          $this->resourceModel =   $resourceModel;
      }


      public  function save($name,$price,$company)
      {
          $mobileModel =  $this->create();

          if (is_array($name,$price,$company)){
              $mobileModel->setData($name,$price,$company);

              try {
                  $this->resourceModel->save($mobileModel);
                  return true;
              }
              catch (\Exception $exception){

              }
          }
          return  false;
      }

    /**
     * @return Mobile
     */
      public function create()
      {
          /**
           * @var $model Model
           */
          $model = $this->modelfactory->create();
          return $model;
      }




}
