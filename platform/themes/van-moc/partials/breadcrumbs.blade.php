<div class="breadcrumb-section">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('public.index') }}">Trang chủ</a></li>
                @if (Theme::has('breadcrumb_category'))
                    <li class="breadcrumb-item"><a href="{{ Theme::get('breadcrumb_category_url') }}">{{ Theme::get('breadcrumb_category') }}</a></li>
                @endif
                <li class="breadcrumb-item active" aria-current="page">{{ Theme::get('section-name') }}</li>
            </ol>
        </nav>
    </div>
</div>