<?php

namespace Codilar\Employee\Model;

use Codilar\Employee\Model\ResourceModel\Work as ResourceModel;
use Codilar\Employee\Model\ResourceModel\Work\Collection;
use Codilar\Employee\Model\ResourceModel\Work\CollectionFactory;
use Codilar\Employee\Model\Work as Model;
use Codilar\Employee\Model\WorkFactory as ModelFactory;
use Magento\Framework\Exception\AlreadyExistsException;

class EmployeeManagement
{
    /**
     * @var ResourceModel
     */
    private $resourceModel;
    /**
     * @var WorkFactory
     */
    private $modelFactory;
    /**
     * @var CollectionFactory
     */
    private $collectionFactory;

    /**
     * EmployeeManagement constructor.
     * @param ResourceModel $resourceModel
     * @param WorkFactory $modelFactory
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
     * @param null $field
     * @return Work
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