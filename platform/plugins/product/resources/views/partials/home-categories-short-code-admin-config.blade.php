<div class="form-group">
    <label class="control-label">{{ trans('plugins/product::categories.number_home_categories_per_page') }}</label>
    {!! Form::number('paginate', theme_option('number_of_categories_in_home', 12), ['class' => 'form-control', 'placeholder' => trans('plugins/product::categories.number_of_categories_in_home')]) !!}
</div>
<div class="form-group">
    <label class="control-label">{{ __('Title') }}</label>
    {!! Form::input('text', 'title', Arr::get($attributes, 'title'), ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    <label class="control-label">{{ __('Description') }}</label>
    {!! Form::textarea('description', old('description'), ['class' => 'form-control', 'rows' => 4, 'data-counter' => 400]) !!}
</div>
