<?php

namespace Mostafa\FAQs\Model\ResourceModel\Question;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected function _construct(): void
    {
        $this->_init('Mostafa\FAQs\Model\Question', 'Mostafa\FAQs\Model\ResourceModel\Question');
    }
}
