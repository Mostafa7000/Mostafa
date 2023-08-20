<?php

namespace Mostafa\FAQs\Ui\Component\Form\Option;

use Magento\Framework\Data\OptionSourceInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Zend_Db_Statement_Exception;

class CategoryOptions implements OptionSourceInterface
{
    public function __construct(private ModuleDataSetupInterface $moduleDataSetup)
    {
    }

    /**
     * Return array of options as value-label pairs
     *
     * @return array Format: array(array('value' => '<value>', 'label' => '<label>'), ...)
     */
    public function toOptionArray(): array
    {
        $query = "SELECT title, id
                FROM categories";
        try {
            $cats = $this->moduleDataSetup->getConnection()->query($query)->fetchAll();
            $options = [];
            foreach ($cats as $cat) {
                $options[] = ['value' => "{$cat['id']}", 'label' => __("{$cat['title']}")];
            }
            return $options;
        } catch (Zend_Db_Statement_Exception $e) {
            return [];
        }
    }
}
