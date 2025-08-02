@php Theme::layout('default'); @endphp

{!! Theme::partial('breadcrumbs') !!}

<section class="section pt-50 pb-50">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="gallery-content">
                    <h1>{{ $gallery->name }}</h1>
                    
                    @if ($gallery->description)
                        <div class="gallery-description">
                            {!! clean($gallery->description) !!}
                        </div>
                    @endif
                    
                    <div class="gallery-images">
                        @foreach ($gallery->images as $image)
                            <div class="gallery-image">
                                @if ($image->image)
                                    <img src="{{ RvMedia::getImageUrl($image->image, 'medium', false, RvMedia::getDefaultImage()) }}" alt="{{ $image->name }}">
                                @else
                                    <img src="{{ RvMedia::getImageUrl(RvMedia::getDefaultImage(), 'medium') }}" alt="{{ $image->name }}">
                                @endif
                                @if ($image->name)
                                    <p class="image-caption">{{ $image->name }}</p>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> 