<?php

namespace App\Modules\Presentation\Forms\Backend\Products;

use App\Modules\Domain\Services\Queries\ProductsCategoriesServiceQuery;
use App\Modules\Infrastructure\Core\IForm;

class ProductsEditForm extends IForm
{
    public function buildForm() {
        $this->create_element();
        $this->create_button();
    }

    /**
     * Create Elements
     *
     * @author nhat_truong
     * @since  2017-12-18
     */
    private function create_element() {
        $service = new ProductsCategoriesServiceQuery();
        $categories = $service->getListForControl();

        $this
            ->add('title', 'text', [
                'label' => 'Tên sản phẩm',
                'rules' => 'required'
            ])
            ->add('alias', 'text', [
                'label' => 'Alias',
                'attr' => [
                    'placeholder' => 'Auto-generate from title'
                ]
            ])
            ->add('description', 'textarea', [
                'label' => 'Mô tả ngắn',
                'attr' => [
                    'rows' => 3
                ]
            ])
            ->add('content', 'textarea', [
                'label' => 'Nội dung',
                'attr' => [
                    'rows' => 3
                ]
            ])
            ->add('price_contact', 'checkbox', [
                'label' => 'Giá liên hệ'
            ])
            ->add('price', 'text', [
                'label' => 'Giá (đ)',
                'attr' => [
                    'data-coco' => 'autonumeric'
                ],
                'rules' => 'max:20'
            ])
            ->add('price_compare', 'text', [
                'label' => 'Giá so sánh (đ)',
                'attr' => [
                    'data-coco' => 'autonumeric'
                ],
                'rules' => 'max:20'
            ])
            ->add('vat', 'checkbox', [
                'label' => 'Giá đã bao gồm VAT'
            ])
            ->add('sku', 'text', [
                'label' => 'Mã sản phẩm / SKU'
            ])
            ->add('barcode', 'text', [
                'label' => 'Mã vạch / Barcode (ISBN, UPC, v.v...)'
            ])
            ->add('inventory', 'select', [
                'label' => 'Quản lý kho',
                'choices' => [
                    '0' => 'Không quản lý kho hàng',
                    '1' => 'Quản lý kho hàng',
                ]
            ])
            ->add('quantity', 'number', [
                'label' => 'Số lượng',
            ])
            ->add('inventory_policy', 'checkbox', [
                'label' => 'Cho phép tiếp tục đặt hàng khi hết hàng',
            ])
            ->add('meta_title', 'text', [
                'label' => 'Thẻ tiêu đề'
            ])
            ->add('meta_description', 'textarea', [
                'label' => 'Thẻ mô tả',
                'attr' => [
                    'rows' => 3
                ]
            ])
            ->addStatusSimple('status', [
                'label_show' => false
            ])
            ->add('publish_up', 'datetimepicker', [
                'label' => 'Thời gian hiển thị'
            ])
            ->add('category_id', 'select', [
                'label' => 'Loại',
                'rules' => 'required',
                'choices' => $categories,
                'attr' => [
                    'class' => 'form-control selectpicker',
                    'data-live-search' => 'true',
                    'data-style' => 'btn btn-outline-secondary',
                    'data-dropup-auto' => 'false',
                    'data-none-selected-text' => ''
                ]
            ])
           /*->add('vendor_id', 'select', [
                'label' => 'Nhà cung cấp',
                'choices' => [
                    '0' => '',
                    '1' => 'Sam sung',
                    '2' => 'Apple',
                ],
                'attr' => [
                    'class' => 'form-control selectpicker',
                    'data-live-search' => 'true',
                    'data-style' => 'btn btn-outline-secondary',
                    'data-dropup-auto' => 'false',
                    'data-none-selected-text' => ''
                ]
            ])*/
            /*->add('group', 'select', [
                'label' => 'Nhóm sản phẩm',
                'choices' => [
                    '1' => 'Sản phẩm nổi bật',
                    '2' => 'Sản phẩm bán chạy',
                ]
            ])*/
            ->add('tags', 'text', [
                'label' => 'Tags'
            ])
            ->addLanguage('language', [], false);
    }

    /**
     * Create Buttons
     *
     * @author nhat_truong
     * @since  2017-12-18
     */
    private function create_button() {
        $this
            ->add('submit', 'submit', [
                'label' => '<i class="fa fa-floppy-o"></i> Save',
                'attr' => [
                    'class' => 'btn btn-success'
                ]
            ])
            ->add('clear', 'reset', [
                'label' => '<i class="fa fa-undo"></i> Reset',
                'attr' => [
                    'class' => 'btn btn-secondary'
                ]
            ]);
    }
}
