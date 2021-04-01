@if (array_key_exists('permission', $menuItem))
    @can($menuItem['permission'])
        <li>
            <a class="has-arrow waves-effect" href="javascript: void(0);">
                <i class="waves-effect {{ array_key_exists('classes', $menuItem) ? $menuItem['classes'] : '' }}"></i>
                <span>{{ __('menus.' . $label) }}</span>
            </a>
            <ul class="sub-menu" aria-expanded="false">
                @foreach ($menuItem['dropdown'] as $index => $item)
                    @include('admin.layouts.components.menu.link', ['menuItem' => $item, 'label' => $index])
                @endforeach
            </ul>
        </li>
    @endcan
@else
    <li>
        <a class="has-arrow waves-effect" href="javascript: void(0);">
            <i class="waves-effect {{ array_key_exists('classes', $menuItem) ? $menuItem['classes'] : '' }}"></i>
            <span>{{ __('menus.' . $label) }}</span>
        </a>
        <ul class="sub-menu" aria-expanded="false">
            @foreach ($menuItem['dropdown'] as $index => $item)
                @include('admin.layouts.components.menu.link', ['menuItem' => $item, 'label' => $index])
            @endforeach
        </ul>
    </li>
@endif
