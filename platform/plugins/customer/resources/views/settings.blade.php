<div class="flexbox-annotated-section">
    <div class="flexbox-annotated-section-annotation">
        <div class="annotated-section-title pd-all-20">
            <h2>{{ trans('plugins/customer::base.settings.title') }}</h2>
        </div>
        <div class="annotated-section-description pd-all-20 p-none-t">
            <p class="color-note">{{ trans('plugins/customer::base.settings.description') }}</p>
        </div>
    </div>

    <div class="flexbox-annotated-section-content">
        <div class="wrapper-content pd-all-20">
            <div class="form-group mb-3">
                <div class="form-group mb-3">
                    <input type="hidden" name="customer_schema_enabled" value="0">
                    <label>
                        <input type="checkbox" value="1" @if (setting('customer_schema_enabled', 1)) checked @endif name="customer_schema_enabled">
                        {{ trans('plugins/customer::base.settings.enable_customer_schema') }}
                    </label>
                    <span class="help-ts">{{ trans('plugins/customer::base.settings.enable_customer_schema_description') }}</span>
                </div>
                <div class="form-group">
                    <label class="text-title-field"
                           for="customer_schema_type">{{ trans('plugins/customer::base.settings.schema_type') }}
                    </label>
                    <div class="ui-select-wrapper">
                        <select name="customer_schema_type" class="ui-select" id="customer_schema_type">
                            @foreach(['NewsArticle', 'News', 'Article', 'customering'] as $type)
                                <option value="{{ $type }}" @if (setting('customer_schema_type', 'NewsArticle') === $type) selected @endif>
                                    {{ $type }}
                                </option>
                            @endforeach
                        </select>
                        <svg class="svg-next-icon svg-next-icon-size-16">
                            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#select-chevron"></use>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
