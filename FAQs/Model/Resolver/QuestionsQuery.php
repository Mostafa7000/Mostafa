<?php


namespace Mostafa\FAQs\Model\Resolver;

use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Query\Resolver\ContextInterface;
use Magento\Framework\GraphQl\Query\Resolver\Value;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Magento\Framework\Setup\ModuleDataSetupInterface;


class QuestionsQuery implements ResolverInterface
{
    const DEFAULT_CATEGORY_ID = 0;

    public function __construct(
        private readonly ModuleDataSetupInterface $dataSetup
    )
    {
    }

    /**
     * Fetches the data from persistence models and format it according to the GraphQL schema.
     *
     * @param Field $field
     * @param ContextInterface $context
     * @param ResolveInfo $info
     * @param array|null $value
     * @param array|null $args
     * @return mixed|Value
     * @throws \Exception
     */
    public function resolve(Field $field, $context, ResolveInfo $info, array $value = null, array $args = null)
    {
        if ($args && array_key_exists('category_id', $args)) {
            $query = "SELECT * FROM questions WHERE category_id=?";
            $id = $args['category_id'];
            $data = $this->dataSetup->getConnection()->query($query, [$id])->fetchAll();
        } else {
            $query = "SELECT * FROM questions";
            $data = $this->dataSetup->getConnection()->query($query)->fetchAll();
        }
        return $data;
    }
}


