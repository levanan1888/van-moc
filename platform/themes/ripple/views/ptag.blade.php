@php Theme::set('section-name', $tag->name) @endphp

@if ($products->count() > 0)
    @foreach ($products as $product)
        <article class="post post__horizontal mb-40 clearfix">
            <div class="post__thumbnail">
                <img src="{{ RvMedia::getImageUrl($product->image, 'medium', false, RvMedia::getDefaultImage()) }}" alt="{{ $product->name }}"><a href="{{ $product->url }}" class="post__overlay"></a>
            </div>
            <div class="post__content-wrap">
                <header class="post__header">
                    <h3 class="post__title"><a href="{{ $product->url }}">{{ $product->name }}</a></h3>
                    <div class="post__meta"><span class="post__created-at"><i class="ion-clock"></i>{{ $product->created_at->translatedFormat('M d, Y') }}</span>
                        @if ($product->author->username)
                            <span class="post__author"><i class="ion-android-person"></i><span>{{ $product->author->name }}</span></span>
                        @endif
                        <span class="post-category"><i class="ion-cube"></i>
                            @if ($product->categories->first())
                                <a href="{{ $product->categories->first()->url }}">{{ $product->categories->first()->name }}</a>
                            @endif
                        </span>
                    </div>
                </header>
                <div class="post__content">
                    <p data-number-line="4">{{ $product->description }}</p>
                </div>
            </div>
        </article>
    @endforeach
    <div class="page-pagination text-right">
        {!! $products->onEachSide(0)->links() !!}
    </div>
@else
    <div class="alert alert-warning">
        <p>{{ __('There is no data to display!') }}</p>
    </div>
@endif
