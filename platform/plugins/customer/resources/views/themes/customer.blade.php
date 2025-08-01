@php
    $dimensions = explode('x', RvMedia::getSize('small'));
@endphp
<div>
    <h3>{{ $customer->name }}kaka</h3>
    {!! Theme::breadcrumb()->render() !!}
</div>
<header>
    <h3>{{ $customer->name }}</h3>
    <div>
        <span>{{ $customer->created_at->format('M d, Y') }}</span>
    </div>
</header>
{!! BaseHelper::clean($customer->content) !!}
<br />
{!! apply_filters(BASE_FILTER_PUBLIC_COMMENT_AREA, null) !!}

@php $relatedCustomers = get_related_customers($customer->id, 2); @endphp

@if ($relatedCustomers->count())
    <footer>
        @foreach ($relatedCustomers as $relatedItem)
            <div>
                <article>
                    <div><a href="{{ $relatedItem->url }}"></a>
                        <img loading="lazy" loading="lazy" src="{{ RvMedia::getImageUrl($relatedItem->image, 'small', false, RvMedia::getDefaultImage()) }}" width="{{ @$dimensions[0] }}" height="{{ @$dimensions[1] }}" alt="{{ $relatedItem->name }}">
                    </div>
                    <header><a href="{{ $relatedItem->url }}"> {{ $relatedItem->name }}</a></header>
                </article>
            </div>
        @endforeach
    </footer>
@endif
