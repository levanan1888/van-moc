@php Theme::layout('default'); @endphp

{!! Theme::partial('breadcrumbs') !!}

<section class="section pt-50 pb-50">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="galleries-content">
                    <h1>{{ trans('plugins/gallery::gallery.galleries') }}</h1>
                    
                    <div class="galleries-grid">
                        @foreach ($galleries as $gallery)
                            <div class="gallery-item">
                                <h3><a href="{{ $gallery->url }}">{{ $gallery->name }}</a></h3>
                                @if ($gallery->image)
                                    <img src="{{ RvMedia::getImageUrl($gallery->image, 'medium', false, RvMedia::getDefaultImage()) }}" alt="{{ $gallery->name }}">
                                @else
                                    <img src="{{ RvMedia::getImageUrl(RvMedia::getDefaultImage(), 'medium') }}" alt="{{ $gallery->name }}">
                                @endif
                                <p>{{ Str::limit(clean($gallery->description), 200) }}</p>
                            </div>
                        @endforeach
                    </div>
                    
                    {!! $galleries->links() !!}
                </div>
            </div>
        </div>
    </div>
</section> 