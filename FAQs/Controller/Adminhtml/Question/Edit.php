<?php

namespace Mostafa\FAQs\Controller\Adminhtml\Question;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Mostafa\FAQs\Model\QuestionFactory;
use Mostafa\FAQs\Model\ResourceModel\Question as QuestionResourceModel;

class Edit extends Action
{
    protected $resultPageFactory;
    public function __construct(
        Context                         $context,
        PageFactory                     $resultPageFactory,
        protected QuestionFactory       $questionFactory,
        protected QuestionResourceModel $questionResourceModel
    )
    {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
        $model = $this->questionFactory->create();
        if ($id) {
            $this->questionResourceModel->load($model, $id);
            if (!$model->getId()) {
                $this->messageManager->addErrorMessage('This category no longer exists.');
                $this->_redirect('*/*/index');
            }
        }

        $resultPage = $this->resultPageFactory->create();
        $resultPage->getConfig()->getTitle()->prepend(__('Edit FAQ'));

        return $resultPage;
    }
}
