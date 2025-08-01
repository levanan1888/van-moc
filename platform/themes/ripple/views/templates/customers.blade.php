<div class="row list-customers">
    @php
    $dimensions = explode('x', RvMedia::getSize('medium'));
    @endphp
    @foreach ($customers as $customer)
        <div class="col-lg-4 col-md-6 col-sm-12 col-12">
            <div class="page-sidebar">
                <div class="widget widget__recent-post widget__recent-customer">
                    <div class="widget__content">
                        <div class="avatar">
                            <a href="{{ $customer->url }}">
                                <img loading="lazy" src="{{ RvMedia::getImageUrl($customer->image, 'medium', false, RvMedia::getDefaultImage()) }}" width="{{ @$dimensions[0] }}" height="{{ @$dimensions[1] }}" alt="{{ $customer->name }}">
                            </a>
                        </div>
                        <div class="content mt-3 p-3">
                            <div class="title"><a href="{{ $customer->url }}">{{ $customer->name }}</a></div>
                            <div class="desc mt-1">{{ Str::limit($customer->description, 80) }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    <div class="page-pagination d-flex align-items-center justify-content-center">
        {!! $customers->withQueryString()->onEachSide(0)->links() !!}
    </div>
</div>
