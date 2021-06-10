<?php


namespace Codilar\User\Model;


use Codilar\User\Model\ResourceModel\Work as ResourceModel;
use Codilar\User\Model\ResourceModel\Work\Collection;
use Codilar\User\Model\ResourceModel\Work\CollectionFactory;
use Codilar\User\Model\Work as Model;
use Codilar\User\Model\WorkFactory as ModelFactory;
use Magento\Framework\Exception\AlreadyExistsException;

class UserManagement
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
    )
    {
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
                'message' => 'User Added Successfully',
                'status' => false
            ];
        } catch (AlreadyExistsException $e) {
            return [
                'message' => 'User with same data already Exist',
                'status' => false
            ];
        } catch (\Exception $e) {
            return [
                'message' => 'Something went wrong!, please contact admin',
                'status' => false
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
     * @return Work
     */
    public function load($id, $field = null)
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

