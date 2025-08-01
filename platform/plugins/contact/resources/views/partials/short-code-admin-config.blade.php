<div class="form-group">
    <label class="control-label">{{ __('Title') }}</label>
    {!! Form::input('text', 'title', Arr::get($attributes, 'title'), ['class' => 'form-control']) !!}
</div>

<div class="form-group mb-3">
    {!! Form::checkbox('bg', '1', true) !!} {{ __('Background') }}
</div>

<div class="form-group mb-3">
    {!! Form::checkbox('is_home', '1', true) !!} {{ __('IsHome') }}
</div>
