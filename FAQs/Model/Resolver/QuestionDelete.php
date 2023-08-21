<?php

namespace Mostafa\FAQs\Model\Resolver;

use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Query\Resolver\ContextInterface;
use Magento\Framework\GraphQl\Query\Resolver\Value;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Exception;
use Mostafa\FAQs\Model\Question as QuestionModel;
use Mostafa\FAQs\Model\ResourceModel\Question as QuestionResourceModel;

class QuestionDelete implements ResolverInterface
{

    public function __construct(
        private ModuleDataSetupInterface $dataSetup,
        private QuestionModel            $questionModel,
        private QuestionResourceModel    $questionResourceModel
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
        $this->questionResourceModel->load($this->questionModel, $args['id']);
        $toBeDeleted = $this->questionModel->getData();
        // check if the model got any data in it
        if (!$toBeDeleted)
            return null;

        $this->questionResourceModel->delete($this->questionModel);
        return $toBeDeleted;
    }
}
