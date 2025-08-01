@php
    $dimensions = explode('x', RvMedia::getSize('medium'));
@endphp
@if ($customers->count() > 0)
    @foreach ($customers as $customer)
        <article>
            <div>
                <a href="{{ $customer->url }}"><img loading="lazy" src="{{ RvMedia::getImageUrl($customer->image, 'medium', false, RvMedia::getDefaultImage()) }}" width="{{ @$dimensions[0] }}" height="{{ @$dimensions[1] }}" alt="{{ $customer->name }}"></a>
            </div>
            <div>
                <header>
                    <h3><a href="{{ $customer->url }}">{{ $customer->name }}</a></h3>
                    <div>
                        <span>{{ $customer->created_at->format('M d, Y') }}</span><span>{{ $customer->author->name }}</span>
                    </div>
                </header>
                <div>
                    <p>{{ $customer->description }}</p>
                </div>
            </div>
        </article>
    @endforeach
    <div>
        {!! $customers->withQueryString()->onEachSide(0)->links() !!}
    </div>
@endif
