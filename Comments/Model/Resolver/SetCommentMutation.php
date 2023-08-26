<?php

namespace Mostafa\Comments\Model\Resolver;

use Exception;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Exception\GraphQlInputException;
use Magento\Framework\GraphQl\Query\Resolver\ContextInterface;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Magento\Quote\Model\QuoteRepository\SaveHandler;
use Magento\QuoteGraphQl\Model\Cart\GetCartForUser;

class SetCommentMutation implements ResolverInterface
{

    public function __construct(
        private readonly GetCartForUser $getCartForUser,
        private readonly SaveHandler    $cartSaveHandler,
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
     * @return array
     * @throws Exception
     */
    public function resolve(Field $field, $context, ResolveInfo $info, array $value = null, array $args = null): array
    {
        if (empty($args['input']['cart_id'])) {
            throw new GraphQlInputException(__('Required parameter "cart_id" is missing'));
        }
        $maskedCartId = $args['input']['cart_id'];

        if (empty($args['input']['comment'])) {
            throw new GraphQlInputException(__('Required parameter "comment" is missing'));
        }
        $comment = $args['input']['comment'];

        $storeId = (int)$context->getExtensionAttributes()->getStore()->getId();
        $cart = $this->getCartForUser->execute($maskedCartId, $context->getUserId(), $storeId);
        $cart->setData('customer_comment', $comment);
        $this->cartSaveHandler->save($cart);

        return [
            'model' => $cart,
        ];
    }
}
