<?php

namespace Mostafa\Comments\Block\Adminhtml\Order\View;

use Magento\Backend\Block\Template;
use Magento\Backend\Block\Template\Context;
use Magento\Backend\Block\Widget\Tab\TabInterface;
use Magento\Framework\Registry;
use Magento\Sales\Api\OrderRepositoryInterface;
use Magento\Sales\Helper\Admin;
use Magento\Sales\Model\Order;

class Comment extends Template
{

    /**
     * Template
     *
     * @var string
     */
    protected $_template = 'Mostafa_Comments::order/view/comment.phtml';

    /**
     * Core registry
     *
     * @var Registry
     */
    protected $_coreRegistry = null;

    /**
     * @param Context $context
     * @param Registry $registry
     * @param Admin $adminHelper
     * @param array $data
     */
    public function __construct(
        Context  $context,
        Registry $registry,
        Admin    $adminHelper,
        array    $data = []
    )
    {
        $this->_coreRegistry = $registry;
        parent::__construct($context, $data);
        $this->adminHelper = $adminHelper;
    }

    /**
     * Retrieve order model instance
     *
     * @return Order
     */
    public function getOrder(): Order
    {
        return $this->_coreRegistry->registry('sales_order');
    }

    public function getComment(): string
    {
        return $this->getOrder()->getData('customer_comment') ?? "";
    }

}

