<?php

namespace Codilar\Employee\Model;

use Codilar\Employee\Model\EmployeeFactory as ModelFactory;
use Codilar\Employee\Model\Employee as Model;
use Codilar\Employee\Model\ResourceModel\Employee as ResourceModel;

class EmployeeManagement
{
    #add=>database=>Model,ResourceModel,Collection
    /**
     * @var \Codilar\Employee\Model\EmployeeFactory
     */
    private $employeeFactory
    /**
     * @var ResourceModel
     */
    private $resourceModel;

    /**
     * EmployeeManagement constructor
     * @param EmployeeFactory $modelfactory
     * @param ResourceModel $resourceModel
     */
    public function __construct(
      ModelFactory $modelfactory,
      ResourceModel $resourceModel
    ) {
         $this->modelfactory =$modelfactory;
         $this->resourceModel =$resourceModel;
    }
    public function save($name,$companyname)
    {
        $employeeModel=$this->create();
        if(is_array($data))
        {
           $employeeModel->setData($data);
           try{
               $this->resourceModel->save($employeeModel);
               return true;
           }
           catch(\Exception $exception)
           {

           }
        }
        return false;
    }
    public function  create()
    {
        /**
         * @var $model Model
         */
        $model =$this->modelfactory->create();
        return $model;
    }
}