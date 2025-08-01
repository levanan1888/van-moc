<div class="form-group mb-3">
    <label class="control-label">{{ trans('plugins/banner::banner.number_of_banners_in_home') }}</label>
    {!! Form::number('paginate', theme_option('number_of_banners_in_home', 12), ['class' => 'form-control', 'placeholder' => trans('plugins/banner::banner.number_of_banners_in_home')]) !!}
</div>
