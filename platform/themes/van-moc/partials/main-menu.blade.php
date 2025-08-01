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
                    @if($row->parent_id == 0)
                        <span class="toggle-icon"><i class="fa fa-angle-down"></i></span>
                    @else
                        <span class="toggle-icon" style="float: right"><i class="fa fa-angle-right"></i></span>
                    @endif
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