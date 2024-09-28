@inject('menus','App\Services\Settings\MenuService')

<!-- Sidebar -->
<div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="info">
            <a href="{{ route('profile.show') }}" class="d-block">{{ Auth::user()->name }}</a>
        </div>
    </div>
    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
            data-accordion="false">
            @foreach($menus->getAccessibleMenusForUser(Auth::user()) as $menu)
                <li class="nav-item">
                @if($menu->id == 2)
                    <a href="#" class="nav-link">
                        <i class="nav-icon {{ $menu->icon }}"></i>
                        <p>
                            {{ $menu->name }}
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" style="display: none;">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Child menu</p>
                            </a>
                        </li>
                    </ul>
                    @elseif($menu->id != 2)
                            <a href="{{route($menu->route_name) }}" class="nav-link">
                                <i class="nav-icon {{ $menu->icon }}"></i>
                                <p>
                                    {{ $menu->name }}
                                </p>
                            </a>
                </li>
                @endif
            @endforeach
        </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->
