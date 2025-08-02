@php Theme::layout('default'); @endphp

{!! Theme::partial('breadcrumbs') !!}

<section class="section pt-50 pb-50">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="customer-content">
                    <h1>{{ $customer->name }}</h1>
                    <div class="customer-info">
                        <p><strong>Email:</strong> {{ $customer->email }}</p>
                        <p><strong>Phone:</strong> {{ $customer->phone }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> 