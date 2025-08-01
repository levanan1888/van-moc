@php
$rand_cls = !empty($shortcode->rand_cls) ? $shortcode->rand_cls : rand(100000,100000000);
@endphp
{!! Form::open(['route' => 'public.send.contact', 'method' => 'POST', 'class' => 'contact-form contact-form-quote', 'id' => 'id-'.$rand_cls]) !!}
<input type="hidden" name="rand_cls" value="{{ $rand_cls }}" />
<div class="row contact-form contact-main-form">
    <div class="col-lg-12 form-row">
        {!! apply_filters('pre_contact_form', null) !!}
        <div class="contact-column-12">
            <div class="contact-form-group is-required">
                <div class="form-input">
                    <input  type="text" class="contact-form-input" name="name" value="{{ old('name') }}"
                    id="contact_name" placeholder="{{ __('Name Placeholder') }}">
                </div>
                <div class="text-error name-error"></div>
            </div>
        </div>
        <div class="contact-column-12">
            <div class="contact-form-group is-required">
                <div class="form-input">
                    <input type="email" class="contact-form-input" name="email" value="{{ old('email') }}"
                        id="contact_email" placeholder="{{ __('Email Placehoder') }}">
                </div>
                <div class="text-error email-error"></div>
            </div>
        </div>
        <div class="contact-column-12">
            <div class="contact-form-group is-required">
                <div class="form-input">
                    <input type="text" class="contact-form-input" name="phone" value="{{ old('phone') }}"
                        id="contact_phone" placeholder="{{ __('Phone Placehoder') }}">
                </div>
                <div class="text-error phone-error"></div>
            </div>
        </div>
        <div class="contact-column-12">
            <div class="contact-form-group is-required">
                <div class="form-input">
                    <textarea name="content" id="contact_content" class="contact-form-input" rows="3"
                        placeholder="{{ __('Message Placehoder') }}">{{ old('content') }}</textarea>
                </div>
                <div class="text-error content-error"></div>
            </div>
        </div>
        <div class="contact-form-group file">
            <label class="" style="width: 100%">
                <input type="file" class="custom-file-input" id="contact-file" name="media" value="{{ old('file') }}"
                id="contact_file" placeholder="">
            </label>
            <div class="text-error media-error"></div>
            <!-- <div class="mt-3"> ({{ trans('plugins/contact::contact.form.file.label', ['extensions' => @theme_option('contact_extensions'), 'capacity' => @theme_option('contact_capacity') ]) }})</div> -->
            <div class="mt-3"> ({{ __('Support extensions :extensions and under :capacityMb', ['extensions' => @theme_option('contact_extensions'), 'capacity' => @theme_option('contact_capacity') ]) }})</div>
        </div>
        @if (is_plugin_active('captcha'))
            @if (setting('enable_captcha'))
                <div class="contact-form-row">
                    <div class="contact-column-12">
                        <div class="contact-form-group">
                            {!! Captcha::display() !!}
                        </div>
                    </div>
                </div>
            @endif

            @if (setting('enable_math_captcha_for_contact_form', 0))
                <div class="contact-form-group contact-captcha">
                    <label for="math-group" class="contact-label required">{{ app('math-captcha')->label() }}</label>
                    {!! app('math-captcha')->input(['class' => 'contact-form-input', 'id' => 'math-group']) !!}
                    <div class="text-error math-captcha-error"></div>
                </div>
            @endif
        @endif

        {!! apply_filters('after_contact_form', null) !!}

        {{-- <div class="contact-form-group">
            <p>{!! BaseHelper::clean(__('The field with (<span style="color:#FF0000;">*</span>) is required.')) !!}</p>
        </div> --}}

        <div class="contact-form-group text-center">
            <button type="submit" class="contact-form contact-button">{{ __('Send Placehoder') }}</button>
        </div>

        <div class="contact-form-group">
            <div class="contact-message contact-success-message" style="display: none"></div>
            <div class="contact-message contact-error-message" style="display: none"></div>
        </div>
    </div>
</div>
{!! Form::close() !!}
