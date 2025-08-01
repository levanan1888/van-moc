{!! Form::open(['route' => 'public.send.comment', 'method' => 'POST', 'class' => 'comment-form']) !!}
<div class="row comment-form">
    <div class="col-lg-12 form-row">
        {!! apply_filters('pre_comment_form', null) !!}
        <div class="comment-column-12">
            <div class="comment-content comment-form-group">
                <h3>{{ __('Comment header title') }}</h3>
                <div>{{ __('Comment header description') }}</div>
            </div>
        </div>
        <div class="comment-column-12">
            <div class="comment-content comment-form-group is-required">
                <textarea name="content" id="comment_content" class="comment-form-input" rows="4"
                    placeholder="{{ __('Comment input content') }}">{{ old('content') }}</textarea><span>(*)</span>
                    <div class="error comment-content-error"></div>
            </div>
        </div>
        <div class="comment-column-12">
            <div class="row">
                <div class="col-lg-4">
                    <div class=" comment-name comment-form-group is-required">
                        <input  type="text" class="comment-form-input" name="name" value="{{ old('name') }}"
                            id="comment_name" placeholder="{{ __('Comment input name') }}"><span>(*)</span>
                            <div class="error comment-content-error"></div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="comment-email comment-form-group is-required">
                        <input type="email" class="comment-form-input" name="email" value="{{ old('email') }}"
                            id="comment_email" placeholder="{{ __('Comment input email') }}"><span>(*)</span>
                            <div class="error comment-name-error"></div>
                    </div>
                </div>
                <div class="col-lg-4 comment-form-group text-center">
                    <button type="submit" class="comment-button comment-form-input">{{ __('Comment submit form') }}</button>
                </div>
            </div>
        </div>

        @if (is_plugin_active('captcha'))
            @if (setting('enable_captcha'))
                <div class="comment-form-row">
                    <div class="comment-column-12">
                        <div class="comment-form-group">
                            {!! Captcha::display() !!}
                        </div>
                    </div>
                </div>
            @endif

            @if (setting('enable_math_captcha_for_comment_form', 0))
                <div class="comment-form-group">
                    <label for="math-group" class="comment-label required">{{ app('math-captcha')->label() }}</label>
                    {!! app('math-captcha')->input(['class' => 'comment-form-input', 'id' => 'math-group']) !!}
                </div>
            @endif
        @endif

        {!! apply_filters('after_comment_form', null) !!}

        <div class="comment-form-group">
            <div class="comment-message comment-success-message" style="display: none"></div>
            <div class="comment-message comment-error-message" style="display: none"></div>
        </div>
    </div>
</div>
{!! Form::close() !!}
