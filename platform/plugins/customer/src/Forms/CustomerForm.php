<?php

namespace Botble\Customer\Forms;

use Botble\Base\Enums\BaseStatusEnum;
use Botble\Base\Forms\Fields\TagField;
use Botble\Base\Forms\FormAbstract;
use Botble\Customer\Http\Requests\CustomerRequest;
use Botble\Customer\Models\Customer;
use Exception;

class CustomerForm extends FormAbstract
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

        $this
            ->setupModel(new Customer())
            ->setValidatorClass(CustomerRequest::class)
            ->withCustomFields()
            ->add('name', 'text', [
                'label' => trans('core/base::forms.name'),
                'label_attr' => ['class' => 'control-label required'],
                'attr' => [
                    'placeholder' => trans('core/base::forms.name_placeholder'),
                    'data-counter' => 150,
                ],
            ])
            ->add('email', 'text', [
                'label' => trans('plugins/customer::customers.form.email'),
                'label_attr' => ['class' => 'control-label'],
                'attr' => [
                    'placeholder' => trans('plugins/customer::customers.form.email_placeholder'),
                    'data-counter' => 150,
                ],
            ])
            ->add('phone', 'text', [
                'label' => trans('plugins/customer::customers.form.phone'),
                'label_attr' => ['class' => 'control-label'],
                'attr' => [
                    'placeholder' => trans('plugins/customer::customers.form.phone_placeholder'),
                    'data-counter' => 150,
                ],
            ])
            ->add('address', 'text', [
                'label' => trans('plugins/customer::customers.form.address'),
                'label_attr' => ['class' => 'control-label'],
                'attr' => [
                    'placeholder' => trans('plugins/customer::customers.form.address_placeholder'),
                    'data-counter' => 255,
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
                'default_value' => 0,
            ])
            ->add('description', 'textarea', [
                'label' => trans('core/base::forms.description'),
                'label_attr' => ['class' => 'control-label'],
                'attr' => [
                    'rows' => 4,
                    'placeholder' => trans('core/base::forms.description_placeholder'),
                    'data-counter' => 400,
                ],
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
            ->add('status', 'customSelect', [
                'label' => trans('core/base::tables.status'),
                'label_attr' => ['class' => 'control-label required'],
                'choices' => BaseStatusEnum::labels(),
            ])
            ->add('logo', 'mediaImage', [
                'label' => trans('plugins/customer::customers.form.logo'),
                'label_attr' => ['class' => 'control-label'],
            ])
            ->add('image', 'mediaImage', [
                'label' => trans('core/base::forms.image'),
                'label_attr' => ['class' => 'control-label'],
            ])
            ->setBreakFieldPoint('status');

        $customerFormats = get_customer_formats(true);

        if (count($customerFormats) > 1) {
            $this->addAfter('status', 'format_type', 'customRadio', [
                'label' => trans('plugins/customer::customers.form.format_type'),
                'label_attr' => ['class' => 'control-label'],
                'choices' => get_customer_formats(true),
            ]);
        }
    }
}
