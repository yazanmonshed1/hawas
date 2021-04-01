<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                @foreach (config('admin.menus_roles')['roles'] as $role)
                    @hasrole($role)
                    @if (array_key_exists('custom_menu', config('admin.menus')[$role]))
                        @if (config('admin.menus')[$role]['type'] == 'template')
                            @include(config('admin.menus')[$role]['custom_menu'])
                        @elseif(config('admin.menus')[$role]['type'] == 'widget')
                            @widget(config('admin.menus')[$role]['custom_menu'])
                        @endif
                    @else
                        @foreach (config('admin.menus')[$role] as $index => $menuItem)
                            @if (array_key_exists('dropdown', $menuItem))
                                @include('admin.layouts.components.menu.dropdown', ['menu' => $menuItem, 'label' =>
                                $index])
                            @else
                                @include('admin.layouts.components.menu.link', ['menuItem' => $menuItem, 'label' =>
                                $index])
                            @endif

                        @endforeach
                    @endif
                    @endhasrole
                @endforeach
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
