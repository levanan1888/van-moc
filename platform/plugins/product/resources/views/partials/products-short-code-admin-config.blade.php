<div class="form-group mb-3">
    <label class="control-label">{{ trans('plugins/product::base.number_products_per_page') }}</label>
    {!! Form::number('paginate', theme_option('number_of_products_in_a_category', 12), ['class' => 'form-control', 'placeholder' => trans('plugins/product::base.number_products_per_page')]) !!}
</div>
