<?php

namespace Mostafa\FAQs\Model\DataProvider;

use Magento\Ui\DataProvider\AbstractDataProvider;
use Mostafa\FAQs\Model\ResourceModel\Question\CollectionFactory;

class Question extends AbstractDataProvider
{
    protected array $loadedData;
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $CollectionFactory,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $CollectionFactory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    public function getData(): array
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }

        $items = $this->collection->getItems();
        $this->loadedData=[];
        foreach ($items as $item) {
            $this->loadedData[$item->getId()] = $item->getData();
        }
        return $this->loadedData;
    }
}
