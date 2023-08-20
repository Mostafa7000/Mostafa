<?php

namespace Mostafa\FAQs\Model\ResourceModel\Category;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected function _construct(): void
    {
        $this->_init('Mostafa\FAQs\Model\Category', 'Mostafa\FAQs\Model\ResourceModel\Category');
    }
}
