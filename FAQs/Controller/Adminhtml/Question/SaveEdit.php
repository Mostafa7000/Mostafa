<?php

namespace Mostafa\FAQs\Controller\Adminhtml\Question;

use Exception;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Mostafa\FAQs\Model\Question as QuestionModel;
use Mostafa\FAQs\Model\ResourceModel\Question as QuestionResourceModel;

class SaveEdit extends Action
{
    protected QuestionModel $questionModel;
    protected QuestionResourceModel $questionResourceModel;

    public function __construct(
        Context               $context,
        QuestionModel         $questionModel,
        QuestionResourceModel $questionResourceModel,
    )
    {
        parent::__construct($context);
        $this->questionModel = $questionModel;
        $this->questionResourceModel= $questionResourceModel;
    }

    public function execute(): void
    {
        $data = $this->getRequest()->getPostValue();
        try {
            // not loading the model forces us to supply id to the setData method
            $model = $this->questionModel;
            $model->addData([
                "id" => $data['id'],
                "title" => $data['title'],
                "answer" => $data['answer'],
                "category_id" => $data['category_id'],
            ]);
            $this->questionResourceModel->save($model);
            $this->messageManager->addSuccessMessage("Success");
        } catch (Exception $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
        }
        $this->_redirect('*/*/index');
    }
}
