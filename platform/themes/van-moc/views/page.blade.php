@php Theme::layout('default'); @endphp

@if ($page->is_introduce_sidebar)
    {!! Theme::partial('breadcrumbs') !!}

    <section class="section pt-50 pb-50">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <div class="page-content">
                        <h1 class="page-title">{{ $page->name }}</h1>
                        
                        @if ($page->description)
                            <div class="page-description">
                                {!! clean($page->description) !!}
                            </div>
                        @endif
                        
                        <div class="page-body">
                            {!! apply_filters(PAGE_FILTER_FRONT_PAGE_CONTENT, clean($page->content), $page) !!}
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="page-sidebar">
                        {!! Theme::partial('sidebar') !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
@else
    {!! Theme::partial('breadcrumbs') !!}

    <section class="section pt-50 pb-50">
        <div class="container">
            <div class="page-content">
                <h1 class="page-title">{{ $page->name }}</h1>
                
                @if ($page->description)
                    <div class="page-description">
                        {!! clean($page->description) !!}
                    </div>
                @endif
                
                <div class="page-body">
                    {!! apply_filters(PAGE_FILTER_FRONT_PAGE_CONTENT, clean($page->content), $page) !!}
                </div>
            </div>
        </div>
    </section>
@endif 