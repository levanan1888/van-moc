<div class="form-group mb-3">
    <label class="control-label">{{ trans('plugins/blog::base.number_posts_in_home') }}</label>
    {!! Form::number('paginate', theme_option('number_of_posts_in_home', 12), ['class' => 'form-control', 'placeholder' => trans('plugins/blog::base.number_posts_in_home')]) !!}
</div>
<div class="form-group">
    <label class="control-label">{{ __('Title') }}</label>
    {!! Form::input('text', 'title', Arr::get($attributes, 'title'), ['class' => 'form-control']) !!}
</div>
