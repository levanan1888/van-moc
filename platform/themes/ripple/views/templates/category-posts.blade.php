<div class="category-posts">
    <div class="page-sidebar">
        <div class="widget widget__recent-post">
            <div class="widget__header widget__header__featured">
                <div class="widget__title">{{ __('Category') }}</div>
            </div>
            <div class="widget__content widget__content__featured">
                <div class="accordion trees-categories" id="menuAccordions">
                    @foreach ($categories as $one)
                        <div class="accordion-item">
                            <div class="accordion-header-1 accordion-header d-flex justify-content-between"
                                id="section-{{ $one->id }}">
                                <a class="link {{ $category->slug == $one->slug ? 'actived' : '' }}"
                                    href="{{ $one->url }}"
                                    class="accordion-link"><strong>{{ $one->name }}</strong></a>
                                @if (!empty($one->children))
                                    <a href="#" class="accordion-button" data-bs-toggle="collapse"
                                        data-bs-target="#collapse-{{ $one->id }}"></a>
                                @endif
                            </div>
                            <div id="collapse-{{ $one->id }}" class="accordion-collapse collapse show"
                                aria-labelledby="section-{{ $one->id }}">
                                @if (!empty($one->children))
                                    <div class="accordion-bd">
                                        @foreach ($one->children as $two)
                                            <div class="accordion-item">
                                                <div class="accordion-header d-flex justify-content-between"
                                                    id="section-{{ $two->id }}">
                                                    <a class="link {{ $category->slug == $two->slug ? 'actived' : '' }}"
                                                        href="{{ $two->url }}"
                                                        class="accordion-link">{{ $two->name }}</a>
                                                    @if (!empty($two->children))
                                                        <a href="#" class="accordion-button"
                                                            data-bs-toggle="collapse"
                                                            data-bs-target="#collapse-{{ $two->id }}"></a>
                                                    @endif
                                                </div>
                                                <div id="collapse-{{ $two->id }}"
                                                    class="accordion-collapse collapse show"
                                                    aria-labelledby="section-{{ $two->id }}">
                                                    @if (!empty($two->children))
                                                        <div class="accordion-bd">
                                                            @foreach ($two->children as $tree)
                                                                <div class="accordion-item">
                                                                    <div class="accordion-header d-flex justify-content-between"
                                                                        id="section-{{ $tree->id }}">
                                                                        <a class="link {{ $category->slug == $tree->slug ? 'actived' : '' }}"
                                                                            href="{{ $tree->url }}"
                                                                            class="accordion-link">{{ $tree->name }}</a>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
