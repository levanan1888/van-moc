<style>
.breadcrumb-section {
    background: #f8f9fa;
    padding: 20px 0;
    border-bottom: 1px solid #e9ecef;
}

.breadcrumb {
    background: transparent;
    padding: 0;
    margin: 0;
    display: flex;
    list-style: none;
    gap: 8px;
    align-items: center;
}

.breadcrumb-item {
    font-size: 14px;
    color: #666;
}

.breadcrumb-item a {
    color: #666;
    text-decoration: none;
    transition: color 0.3s ease;
}

.breadcrumb-item a:hover {
    color: #28a745;
}

.breadcrumb-item.active {
    color: #333;
    font-weight: 500;
}

.breadcrumb-item:not(:last-child)::after {
    content: ">";
    margin-left: 8px;
    color: #ccc;
}
</style>

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