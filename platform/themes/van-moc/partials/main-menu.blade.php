<ul {!! BaseHelper::clean($options) !!}>
    @foreach ($menu_nodes->loadMissing('metadata') as $key => $row)
        @php
        $cls_root = $row->parent_id == 0 ? 'root' : '';
        @endphp
        <li class="menu-item-{{ $cls_root }} menu-item @if ($row->has_child) menu-item-has-children menu-item-has-children-{{ $cls_root }} @endif {{ $row->css_class }} @if ($row->active) active @endif">
            <a href="{{ $row->url }}" target="{{ $row->target }}">
                @if ($iconImage = $row->getMetadata('icon_image', true))
                    <img src="{{ RvMedia::getImageUrl($iconImage) }}" alt="icon image" class="menu-icon-image" />
                @elseif ($row->icon_font)<i class='{{ trim($row->icon_font) }}'></i> @endif{{ $row->title }}<span class="underline-{{ $cls_root }}"></span>
                @if ($row->has_child)
                    <span class="toggle-icon">
                    @if($row->parent_id == 0)
                            <i class="fa fa-chevron-down"></i>
                    @else
                            <i class="fa fa-chevron-right"></i>
                    @endif
                    </span>
                @endif
            </a>
            @if ($row->has_child)
                {!!
                    Menu::generateMenu([
                        'menu'       => $menu,
                        'menu_nodes' => $row->child,
                        'view'       => 'main-menu',
                        'options'    => ['class' => "sub-menu sub-menu-$cls_root"],
                    ])
                !!}
            @endif
        </li>
    @endforeach
</ul> 