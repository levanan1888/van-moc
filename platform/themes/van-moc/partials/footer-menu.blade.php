<ul {!! BaseHelper::clean($options) !!}>
    @foreach ($menu_nodes->loadMissing('metadata') as $key => $row)
        <li class="menu-item {{ $row->css_class }} @if ($row->active) active @endif">
            <a href="{{ $row->url }}" target="{{ $row->target }}">
                @if ($iconImage = $row->getMetadata('icon_image', true))
                    <img src="{{ RvMedia::getImageUrl($iconImage) }}" alt="icon image" class="menu-icon-image" />
                @elseif ($row->icon_font)<i class='{{ trim($row->icon_font) }}'></i> @endif{{ $row->title }}
            </a>
        </li>
    @endforeach
</ul> 