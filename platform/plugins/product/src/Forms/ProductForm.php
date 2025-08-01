<?php

namespace Botble\Product\Forms;

use Botble\Base\Enums\BaseStatusEnum;
use Botble\Base\Forms\Fields\TagField;
use Botble\Base\Forms\FormAbstract;
use Botble\Product\Forms\Fields\CategoryMultiField;
use Botble\Product\Http\Requests\ProductRequest;
use Botble\Product\Models\Product;
use Botble\Product\Repositories\Interfaces\CategoryInterface;
use Exception;

class ProductForm extends FormAbstract
{
    /**
     * @var string
     */
    protected $template = 'core/base::forms.form-tabs';

    /**
     * {@inheritDoc}
     * @throws Exception
     */
    public function buildForm()
    {
        $selectedCategories = [];
        if ($this->getModel()) {
            $selectedCategories = $this->getModel()->categories()->pluck('category_id')->all();
        }

        if (empty($selectedCategories)) {
            $selectedCategories = app(CategoryInterface::class)
                ->getModel()
                ->where('is_default', 1)
                ->pluck('id')
                ->all();
        }

        $tags = null;

        if ($this->getModel()) {
            $tags = $this->getModel()->tags()->pluck('name')->all();
            $tags = implode(',', $tags);
        }

        if (!$this->formHelper->hasCustomField('categoryMulti')) {
            $this->formHelper->addCustomField('categoryMulti', CategoryMultiField::class);
        }

        $this
            ->setupModel(new Product())
            ->setValidatorClass(ProductRequest::class)
            ->withCustomFields()
            ->addCustomField('ptags', TagField::class)
            ->add('code', 'text', [
                'label' => trans('plugins/product::products.form.code'),
                'label_attr' => ['class' => 'control-label required'],
                'attr' => [
                    'placeholder' => trans('core/base::forms.name_placeholder'),
                    'data-counter' => 100,
                ],
            ])
            ->add('name', 'text', [
                'label' => trans('core/base::forms.name'),
                'label_attr' => ['class' => 'control-label required'],
                'attr' => [
                    'placeholder' => trans('core/base::forms.name_placeholder'),
                    'data-counter' => 150,
                ],
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
            ->add('is_featured', 'onOff', [
                'label' => trans('core/base::forms.is_featured'),
                'label_attr' => ['class' => 'control-label'],
                'default_value' => false,
            ])
            ->add('order', 'number', [
                'label' => trans('core/base::forms.order'),
                'label_attr' => ['class' => 'control-label'],
                'attr' => [
                    'placeholder' => trans('core/base::forms.order_by_placeholder'),
                ],
                'default_value' => 1000,
            ])
            ->add('content', 'editor', [
                'label' => trans('core/base::forms.content'),
                'label_attr' => ['class' => 'control-label'],
                'attr' => [
                    'rows' => 4,
                    'placeholder' => trans('core/base::forms.description_placeholder'),
                    'with-short-code' => true,
                ],
            ])
            ->add('images[]', 'mediaImages', [
                'label' => trans('plugins/product::products.form.images'),
                'label_attr' => ['class' => 'control-label'],
                'values' => !empty($this->model->images) ? $this->model->images : [],
            ])
            ->add('video', 'mediaFile', [
                'label' => trans('plugins/product::products.form.video'),
                'label_attr' => ['class' => 'control-label'],
                'values' => !empty($this->model->images) ? $this->model->images : [],
            ])
            ->add('video_poster', 'mediaImage', [
                'label' => trans('plugins/product::products.form.video_poster'),
                'label_attr' => ['class' => 'control-label'],
            ])
            ->add('status', 'customSelect', [
                'label' => trans('core/base::tables.status'),
                'label_attr' => ['class' => 'control-label required'],
                'choices' => BaseStatusEnum::labels(),
            ])
            ->add('categories[]', 'categoryMulti', [
                'label' => trans('plugins/product::products.form.categories'),
                'label_attr' => ['class' => 'control-label required'],
                'choices' => get_pcategories_with_children(),
                'value' => old('pcategories', $selectedCategories),
            ])
            ->add('image', 'mediaImage', [
                'label' => trans('core/base::forms.image'),
                'label_attr' => ['class' => 'control-label'],
            ])
            ->add('tag', 'ptags', [
                'label' => trans('plugins/product::products.form.tags'),
                'label_attr' => ['class' => 'control-label'],
                'value' => $tags,
                'attr' => [
                    'placeholder' => trans('plugins/blog::base.write_some_tags'),
                    'data-url' => route('tags.all'),
                ],
            ])
            ->setBreakFieldPoint('status');

        $productFormats = get_product_formats(true);

        if (count($productFormats) > 1) {
            $this->addAfter('status', 'format_type', 'customRadio', [
                'label' => trans('plugins/product::products.form.format_type'),
                'label_attr' => ['class' => 'control-label'],
                'choices' => get_product_formats(true),
            ]);
        }
    }
}
