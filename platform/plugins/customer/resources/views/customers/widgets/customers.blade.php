@if ($customers->count() > 0)
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
            @foreach($customers as $customer)
                <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td>@if ($customer->slug) <a href="{{ $customer->url }}" target="_blank">{{ Str::limit($customer->name, 80) }}</a> @else <strong>{{ Str::limit($customer->name, 80) }}</strong> @endif</td>
                    <td>{{ BaseHelper::formatDate($customer->created_at, 'd-m-Y') }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    @if ($customers instanceof Illuminate\Pagination\LengthAwarePaginator)
        <div class="widget_footer">
            @include('core/dashboard::partials.paginate', ['data' => $customers, 'limit' => $limit])
        </div>
    @endif
@else
    @include('core/dashboard::partials.no-data', ['message' => trans('plugins/customer::customers.no_new_customer_now')])
@endif
