<?php

namespace Mostafa\FAQs\Ui\Component\Listing\Column;

use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;
use Magento\Framework\UrlInterface;

class CategoryActions extends Column
{
    const EDIT_PATH = 'faqs/category/edit';
    const DELETE_PATH = 'faqs/category/Delete';

    protected UrlInterface $urlBuilder;

    public function __construct(
        ContextInterface   $context,
        UiComponentFactory $uiComponentFactory,
        UrlInterface       $urlBuilder,
        array              $components = [],
        array              $data = []
    )
    {
        $this->urlBuilder = $urlBuilder;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    public function prepareDataSource(array $dataSource): array
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as & $item) {
                $name = $this->getData('name');

                if (isset($item['id'])) {
                    $item[$name] = [
                        'edit' => [
                            'href' => $this->urlBuilder->getUrl(self::EDIT_PATH, ['id' => $item['id']]),
                            'label' => __('Edit')
                        ],
                        'delete' => [
                            'href' => $this->urlBuilder->getUrl(self::DELETE_PATH, ['id' => $item['id']]),
                            'label' => __('Delete')
                        ],
                    ];
                }
            }
        }

        return $dataSource;
    }
}
