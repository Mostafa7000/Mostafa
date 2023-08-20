<?php

namespace Mostafa\FAQs\Model;

use Magento\Framework\Model\AbstractModel;

class Question extends AbstractModel
{
    const CACHE_TAG = 'id';
    protected function _construct(): void
    {
        $this->_init('Mostafa\FAQs\Model\ResourceModel\Question');
    }

    public function getIdentities(): array
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

}
