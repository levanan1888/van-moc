<?php

namespace Botble\Product\Forms;

use Botble\Base\Enums\BaseStatusEnum;
use Botble\Base\Forms\FormAbstract;
use Botble\Product\Http\Requests\CategoryRequest;
use Botble\Product\Models\Category;

class CategoryForm extends FormAbstract
{
    /**
     * {@inheritDoc}
     */
    public function buildForm()
    {
        $list = get_pcategories();

        $categories = [];
        foreach ($list as $row) {
            if ($this->getModel() && ($this->model->id === $row->id || $this->model->id === $row->parent_id)) {
                continue;
            }

            $categories[$row->id] = $row->indent_text . ' ' . $row->name;
        }
        $categories = [0 => trans('plugins/product::categories.none')] + $categories;

        $this
            ->setupModel(new Category())
            ->setValidatorClass(CategoryRequest::class)
            ->withCustomFields()
            ->add('name', 'text', [
                'label' => trans('core/base::forms.name'),
                'label_attr' => ['class' => 'control-label required'],
                'attr' => [
                    'placeholder' => trans('core/base::forms.name_placeholder'),
                    'data-counter' => 120,
                ],
            ])
            ->add('parent_id', 'customSelect', [
                'label' => trans('core/base::forms.parent'),
                'label_attr' => ['class' => 'control-label required'],
                'attr' => [
                    'class' => 'select-search-full',
                ],
                'choices' => $categories,
            ])
            ->add('description', 'editor', [
                'label' => trans('core/base::forms.description'),
                'label_attr' => ['class' => 'control-label'],
                'attr' => [
                    'rows' => 4,
                    'placeholder' => trans('core/base::forms.description_placeholder'),
                    'with-short-code' => false,
                ],
            ])
            ->add('is_default', 'onOff', [
                'label' => trans('core/base::forms.is_default'),
                'label_attr' => ['class' => 'control-label'],
                'default_value' => false,
            ])
            ->add('icon', 'text', [
                'label' => trans('core/base::forms.icon'),
                'label_attr' => ['class' => 'control-label'],
                'attr' => [
                    'placeholder' => 'Ex: fa fa-home',
                    'data-counter' => 60,
                ],
            ])
            ->add('order', 'number', [
                'label' => trans('core/base::forms.order'),
                'label_attr' => ['class' => 'control-label'],
                'attr' => [
                    'placeholder' => trans('core/base::forms.order_by_placeholder'),
                ],
                'default_value' => 0,
            ])
            ->add('home_order', 'number', [
                'label' => trans('plugins/product::categories.form.home_order'),
                'label_attr' => ['class' => 'control-label'],
                'attr' => [
                    'placeholder' => trans('plugins/product::categories.form.home_order'),
                ],
                'default_value' => 0,
            ])
            ->add('is_featured', 'onOff', [
                'label' => trans('core/base::forms.is_featured'),
                'label_attr' => ['class' => 'control-label'],
                'default_value' => false,
            ])
            ->add('status', 'customSelect', [
                'label' => trans('core/base::tables.status'),
                'label_attr' => ['class' => 'control-label required'],
                'choices' => BaseStatusEnum::labels(),
            ])
            ->add('banner', 'mediaImage', [
                'label' => trans('plugins/product::categories.form.banner'),
                'label_attr' => ['class' => 'control-label'],
            ])
            ->add('image', 'mediaImage', [
                'label' => trans('plugins/product::categories.form.image'),
                'label_attr' => ['class' => 'control-label'],
            ])
            ->add('image_size', 'mediaImage', [
                'label' => trans('plugins/product::categories.form.image_size'),
                'label_attr' => ['class' => 'control-label'],
            ])
            ->add('image_color', 'mediaImage', [
                'label' => trans('plugins/product::categories.form.image_color'),
                'label_attr' => ['class' => 'control-label'],
            ])
            ->setBreakFieldPoint('status');
    }
}
