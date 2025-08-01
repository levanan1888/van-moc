@if ($products->count() > 0)
    <div class="scroller">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>#</th>
                <th>{{ trans('core/base::tables.name') }}</th>
                <th>{{ trans('core/base::tables.created_at') }}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($products as $product)
                <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td>@if ($product->slug) <a href="{{ $product->url }}" target="_blank">{{ Str::limit($product->name, 80) }}</a> @else <strong>{{ Str::limit($product->name, 80) }}</strong> @endif</td>
                    <td>{{ BaseHelper::formatDate($product->created_at, 'd-m-Y') }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    @if ($products instanceof Illuminate\Pagination\LengthAwarePaginator)
        <div class="widget_footer">
            @include('core/dashboard::partials.paginate', ['data' => $products, 'limit' => $limit])
        </div>
    @endif
@else
    @include('core/dashboard::partials.no-data', ['message' => trans('plugins/product::products.no_new_product_now')])
@endif
