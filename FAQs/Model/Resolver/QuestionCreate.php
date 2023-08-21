<?php

namespace Mostafa\FAQs\Model\Resolver;

use Exception;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Query\Resolver\ContextInterface;
use Magento\Framework\GraphQl\Query\Resolver\Value;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Mostafa\FAQs\Model\Question as QuestionModel;
use Mostafa\FAQs\Model\ResourceModel\Question as QuestionResourceModel;

class QuestionCreate implements ResolverInterface
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
     * @throws Exception
     */
    public function resolve(Field $field, $context, ResolveInfo $info, array $value = null, array $args = null)
    {
        // Create new Category
        $this->questionModel->addData($args['input']);
        // Save the model in the database or return null if data is not valid
        try {
            $this->questionResourceModel->save($this->questionModel);
        } catch (Exception $e) {
            return null;
        }

        // Return the newly created Category
        return $this->questionModel->getData();

    }
}
