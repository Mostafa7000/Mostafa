<?php

namespace Mostafa\FAQs\Controller\Adminhtml\Category;

use Exception;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class Delete extends Action
{
    public function __construct(
        Context                    $context,
        protected ModuleDataSetupInterface $dataSetup
    )
    {
        parent::__construct($context);
    }

    public function execute(): void
    {
        $selectedId = $this->getRequest()->getParam('id');

        try {
            $this->dataSetup->getConnection()->query('DELETE FROM categories WHERE id=?',[$selectedId]);
            $this->messageManager->addSuccessMessage('Items deleted successfully.');
        } catch (Exception $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
        }
        $this->_redirect('*/*/index');
    }
}

