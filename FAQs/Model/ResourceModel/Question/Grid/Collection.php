<?php

namespace Mostafa\FAQs\Model\ResourceModel\Question\Grid;

use Magento\Framework\Data\Collection\Db\FetchStrategyInterface as FetchStrategy;
use Magento\Framework\Data\Collection\EntityFactoryInterface as EntityFactory;
use Magento\Framework\Event\ManagerInterface as EventManager;
use Magento\Framework\View\Element\UiComponent\DataProvider\SearchResult;
use Psr\Log\LoggerInterface as Logger;

class Collection extends SearchResult
{
    protected $_idFieldName = 'id';

    public function __construct(
        EntityFactory $entityFactory,
        Logger        $logger,
        FetchStrategy $fetchStrategy,
        EventManager  $eventManager,
                      $mainTable = 'questions',
                      $resourceModel = 'Mostafa\FAQs\Model\ResourceModel\Question',
                      $identifierName = null,
                      $connectionName = null
    )
    {
        parent::__construct($entityFactory, $logger, $fetchStrategy, $eventManager, $mainTable, $resourceModel, $identifierName, $connectionName);
    }

    /**
     * @return void
     */
    protected function _initSelect(): void
    {
        parent::_initSelect();

        // Join the 2nd Table
        $this->getSelect()
            ->joinLeft(
                ['categories' => $this->getConnection()->getTableName('categories')],
                'main_table.category_id = categories.id',
                ['categories_title' => 'categories.title']
            );
    }
}
