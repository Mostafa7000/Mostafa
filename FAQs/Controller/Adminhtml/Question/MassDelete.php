<?php

namespace Mostafa\FAQs\Controller\Adminhtml\Question;

use Exception;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Mostafa\FAQs\Model\ResourceModel\Question\CollectionFactory;

class MassDelete extends Action
{
    protected CollectionFactory $collectionFactory;

    public function __construct(
        Context $context,
        CollectionFactory $collectionFactory
    ) {
        parent::__construct($context);
        $this->collectionFactory = $collectionFactory;
    }

    public function execute()
    {
        $selectedIds = $this->getRequest()->getParam('selected');

        if (!is_array($selectedIds)) {
            $this->messageManager->addErrorMessage('Please select items to delete.');
        } else {
            try {
                $collection = $this->collectionFactory->create();
                $collection->addFieldToFilter('id', ['in' => $selectedIds]);
                $collection->walk('delete');

                $this->messageManager->addSuccessMessage('Items deleted successfully.');
            } catch (Exception $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            }
        }

        $this->_redirect('*/*/index');
    }
}

