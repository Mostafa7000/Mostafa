<?php

namespace Mostafa\FAQs\Model\Resolver;

use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Query\Resolver\ContextInterface;
use Magento\Framework\GraphQl\Query\Resolver\Value;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Mostafa\FAQs\Model\Category as CategoryModel;
use Mostafa\FAQs\Model\ResourceModel\Category as CategoryResourceModel;

class CategoryDelete implements ResolverInterface
{

    public function __construct(
        private CategoryModel            $categoryModel,
        private CategoryResourceModel    $categoryResourceModel
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
        $this->categoryResourceModel->load($this->categoryModel,$args['id']);
        $toBeDeleted= $this->categoryModel->getData();
        $this->categoryResourceModel->delete($this->categoryModel);
        return $toBeDeleted;
    }
}
