<?php

namespace Mostafa\Comments\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class QuoteSubmitBefore implements ObserverInterface
{

    /**
     * @param Observer $observer
     * @return void
     */
    public function execute(Observer $observer): void
    {
        $quote = $observer->getQuote();
        $order = $observer->getOrder();

        $order->setData('customer_comment', $quote->getData('customer_comment'));
    }
}
