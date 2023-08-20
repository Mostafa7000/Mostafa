<?php

namespace Mostafa\FAQs\Controller\Adminhtml\Category;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Mostafa\FAQs\Model\CategoryFactory;
use Mostafa\FAQs\Model\ResourceModel\Category as CategoryResourceModel;

class Edit extends Action
{
    protected $resultPageFactory;
    protected $categoryFactory;
    protected $categoryResourceModel;

    public function __construct(
        Context               $context,
        PageFactory           $resultPageFactory,
        CategoryFactory       $categoryFactory,
        CategoryResourceModel $categoryResourceModel
    )
    {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
        $this->categoryFactory = $categoryFactory;
        $this->categoryResourceModel = $categoryResourceModel;
    }

    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
        $model = $this->categoryFactory->create();
        if ($id) {
            $this->categoryResourceModel->load($model, $id);
            if (!$model->getId()) {
                $this->messageManager->addErrorMessage('This category no longer exists.');
                $this->_redirect('*/*/index');
            }
        }

        $resultPage = $this->resultPageFactory->create();
        $resultPage->getConfig()->getTitle()->prepend(__('Edit Category'));

        return $resultPage;
    }
}
