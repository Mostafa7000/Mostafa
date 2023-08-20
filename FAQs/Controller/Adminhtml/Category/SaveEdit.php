<?php

namespace Mostafa\FAQs\Controller\Adminhtml\Category;

use Exception;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Mostafa\FAQs\Model\CategoryFactory as CategoryModelFactory;
use Mostafa\FAQs\Model\ResourceModel\Category as CategoryResourceModel;

class SaveEdit extends Action
{
    protected CategoryModelFactory $categoryModelFactory;
    protected CategoryResourceModel $categoryResourceModel;

    public function __construct(
        Context                                           $context,
        CategoryModelFactory                              $categoryModelFactory,
        CategoryResourceModel $categoryResourceModel,
    )
    {
        parent::__construct($context);
        $this->categoryModelFactory = $categoryModelFactory;
        $this->categoryResourceModel= $categoryResourceModel;
    }

    public function execute(): void
    {
        $data = $this->getRequest()->getPostValue();
        try {
            $model = $this->categoryModelFactory->create();
            $model->setData([
                "id"=> $data['id'],
                "title" => $data['title'],
            ]);
            $this->categoryResourceModel->save($model);
            $this->messageManager->addSuccessMessage("Success");
        } catch (Exception $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
        }
        $this->_redirect('*/*/index');
    }
}
