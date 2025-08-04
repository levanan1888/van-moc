<div class="form-group mb-3">
    <label class="control-label">{{ __('Title') }}</label>
    {!! Form::text('title', $shortcode->title ?? 'Bắt đầu hành trình<br>sống lành từ Vạn Mộc', ['class' => 'form-control', 'placeholder' => __('Enter title')]) !!}
</div>

<div class="form-group mb-3">
    <label class="control-label">{{ __('Subtitle') }}</label>
    {!! Form::textarea('subtitle', $shortcode->subtitle ?? 'Chăm sóc làn da và cơ thể không chỉ là thói quen, mà là hành trình yêu thương bản thân một cách trọn vẹn - bắt đầu từ những điều thuần khiết nhất.', ['class' => 'form-control', 'placeholder' => __('Enter subtitle'), 'rows' => 3]) !!}
</div>

<div class="form-group mb-3">
    <label class="control-label">{{ __('Button Text') }}</label>
    {!! Form::text('button_text', $shortcode->button_text ?? 'Khám phá sản phẩm', ['class' => 'form-control', 'placeholder' => __('Enter button text')]) !!}
</div>

<div class="form-group mb-3">
    <label class="control-label">{{ __('Button URL') }}</label>
    {!! Form::text('button_url', $shortcode->button_url ?? '#', ['class' => 'form-control', 'placeholder' => __('Enter button URL')]) !!}
</div>

<div class="form-group mb-3">
    <label class="control-label">{{ __('Show Banner') }}</label>
    {!! Form::onOff('show_banner', $shortcode->show_banner ?? true) !!}
    <small class="form-text text-muted">{{ __('Enable to show banner from plugin') }}</small>
</div> 