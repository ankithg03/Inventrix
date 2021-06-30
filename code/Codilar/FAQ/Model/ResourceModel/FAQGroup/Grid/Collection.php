<?php

namespace Codilar\FAQ\Model\ResourceModel\FAQGroup\Grid;

use Magento\Framework\Api\Search\AggregationInterface;
use Magento\Framework\Api\Search\SearchResultInterface;
use Magento\Framework\Data\Collection\Db\FetchStrategyInterface;
use Magento\Framework\Data\Collection\EntityFactoryInterface;
use Magento\Framework\DB\Adapter\AdapterInterface;
use Magento\Framework\Event\ManagerInterface;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use Psr\Log\LoggerInterface;



class Collection extends \Codilar\FAQ\Model\ResourceModel\FAQGroup\Collection implements SearchResultInterface
{
    /**
     * Collection constructor.
     * @param EntityFactoryInterface $entityFactory
     * @param LoggerInterface $logger
     * @param FetchStrategyInterface $fetchStrategy
     * @param ManagerInterface $eventManager
     * @param AdapterInterface|null $connection
     * @param AbstractDb|null $resource
     */
    public function __construct(
        EntityFactoryInterface $entityFactory,
        LoggerInterface $logger,
        FetchStrategyInterface $fetchStrategy,
        ManagerInterface $eventManager,
        AdapterInterface $connection = null,
        AbstractDb $resource = null
    ) {
        parent::__construct($entityFactory, $logger, $fetchStrategy, $eventManager, $connection, $resource);
    }

    /** @var int $idCounter */
    private $idCounter = 0;

    /**
     * @var AggregationInterface
     */
    private $aggregations;

    /**
     * @param array|null $items
     * @return $this|Collection
     */
    public function setItems(array $items = null)
    {
        return $this;
    }
    /**
     * @return AggregationInterface
     */
    public function getAggregations()
    {
        return $this->aggregations;
    }
    /**
     * @param AggregationInterface $aggregations
     * @return $this|Collection
     */
    public function setAggregations($aggregations)
    {
        $this->aggregations = $aggregations;
        return $this;
    }
    /**
     * @return null
     */
    public function getSearchCriteria()
    {
        return null;
    }
    public function setSearchCriteria($searchCriteria)
    {
        return $this;
    }

    /**
     * @return int
     */
    public function getTotalCount()
    {
        return $this->getSize();
    }

    /**
     * @param int $totalCount
     * @return $this|Collection
     */
    public function setTotalCount($totalCount)
    {
        return $this;
    }
}
