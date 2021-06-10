<?php

namespace Codilar\Employee\Model;

use Codilar\Employee\Model\ResourceModel\Employee as ResourceModel;
use Codilar\Employee\Model\ResourceModel\Employee\Collection;
use Codilar\Employee\Model\ResourceModel\Employee\CollectionFactory;
use Codilar\Employee\Model\Employee as Model;
use Codilar\Employee\Model\EmployeeFactory as ModelFactory;
use Magento\Framework\Exception\AlreadyExistsException;

class EmployeeManagement
{
    /**
     * @var ResourceModel
     */
    private $resourceModel;
    /**
     * @var EmployeeFactory
     */
    private $modelFactory;
    /**
     * @var CollectionFactory
     */
    private $collectionFactory;

    /**
     * EmployeeManagement constructor.
     * @param ResourceModel $resourceModel
     * @param EmployeeFactory $modelFactory
     * @param CollectionFactory $collectionFactory
     */
    public function __construct(
        ResourceModel $resourceModel,
        ModelFactory $modelFactory,
        CollectionFactory $collectionFactory
    ) {
        $this->resourceModel = $resourceModel;
        $this->modelFactory = $modelFactory;
        $this->collectionFactory = $collectionFactory;
    }

    /**
     * @param $dataInArray
     * @return array
     */
    public function save($dataInArray)
    {
        /**
         * @var $model Model
         */
        $model = $this->create();
        $model->setData($dataInArray);
        try {
            $this->resourceModel->save($model);
            return [
                'message'=>'Employee Added Successfully',
                'status'=>false
            ];
        } catch (AlreadyExistsException $e) {
            return [
                'message'=>'Employee with same data already Exist',
                'status'=>false
            ];
        } catch (\Exception $e) {
            return [
                'message'=>'Something went wrong!, please contact admin',
                'status'=>false
            ];
        }
    }

    /**
     * @return array
     */
    public function getData()
    {
        return $this->collectionFactory->create()->getData();
    }

    /**
     * @param $id
     * @return bool
     */
    public function deleteById($id)
    {
        try {
            $model = $this->load($id);
            $this->resourceModel->delete($model);
            return true;
        } catch (\Exception  $e) {
            return false;
        }
    }

    /**
     * @param $id
     * @param null $field
     * @return Employee
     */
    public function load($id, $field=null)
    {
        $model = $this->create();
        $this->resourceModel->load($model, $id, $field);
        return $model;
    }

    /**
     * @return Model
     */
    public function create()
    {
        return $this->modelFactory->create();
    }

    /**
     * @return Collection
     */
    public function getCollection()
    {
        return $this->collectionFactory->create();
    }
}