@php
if ($menuItem['link_type'] == 'static') {
    $link = $menuItem['link'];
} else {
    $param = array_key_exists('param', $menuItem) && $menuItem['param'] ? auth()->user()->id : null;
    $link = $param ? route($menuItem['link'], ['user_id' => $param]) : route($menuItem['link']);
}
$show =
    array_key_exists('permission', $menuItem) &&
    !auth()
        ->user()
        ->can($menuItem['permission'])
        ? false
        : true;
@endphp
@if ($show)
    <li>
        <a href="{{ $link }}">
            <i class="waves-effect {{ array_key_exists('classes', $menuItem) ? $menuItem['classes'] : '' }}"></i>
            <span>{{ __('menus.' . $label) }}</span>
        </a>
    </li>
@endif
