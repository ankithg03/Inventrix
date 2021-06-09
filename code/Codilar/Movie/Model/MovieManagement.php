<?php

namespace  Codilar\Movie\Model;

use Codilar\Movie\Model\MovieFactory as ModelFactory;

use Codilar\Movie\Model\Movie as Model;


use Codilar\Movie\Model\ResourceModel\Movie as ResourceModel;

class  MovieManagement
{


    /**
     * @var
     */
    private $movieFactory;


    /**
     * @var ResourceModel
     */
    private $resourceModel;


    /**
     * MobileManagement constructor.
     * @param MovieFactory $modelfactory
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


      public  function save($name,$description,$rating)
      {
          $movieModel =  $this->create();

              $movieModel->setData($data);

              try {
                  $this->resourceModel->save($movieModel);
                  return true;
              }
              catch (\Exception $exception){

              }

      }

    /**
     * @return Movie
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
