<aside class="main-sidebar sidebar-dark-primary elevation-4 h-max">
    <!-- Brand Logo -->
    <a href="{{route('dashboard')}}" class="brand-link">
        <img
            src="{{ asset('dist/img/AdminLTELogo.png') }}"
            alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3"
            style="opacity: 0.8"
        />
        <span class="brand-text font-weight-light">Blood Bank</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img
                    src="{{ asset('dist/img/user2-160x160.jpg') }}"
                    class="img-circle elevation-2"
                    alt="User Image"
                />
            </div>
            <div class="info">
                <a href="profile" class="d-block">{{ Auth::user()->name }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2 ">
            <ul class="nav nav-pills nav-sidebar flex-column"
                data-widget="treeview"
                role="menu"
                data-accordion="false">
                
                <!-- Each link is now a single nav-item -->
                <li class="nav-item">
                    <a href="/admin/governorate" class="nav-link {{ request()->is('admin/governorate') ? 'active' : '' }}">
                        <i class="nav-icon fa fa-globe"></i>
                        <p>Governorates</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="/admin/city" class="nav-link {{ request()->is('admin/city') ? 'active' : '' }}">
                        <i class="nav-icon far fa fa-flag"></i>
                        <p>Cities</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="/admin/blood-type" class="nav-link {{ request()->is('admin/blood-type') ? 'active' : '' }}">
                        <i class="nav-icon far fa fa-tint"></i>
                        <p>Blood Types</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="/admin/donation-request" class="nav-link {{ request()->is('admin/donation-request') ? 'active' : '' }}">
                        <i class="nav-icon far fa fa-medkit "></i>
                        <p>Donation Requests</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="/admin/category" class="nav-link {{ request()->is('admin/category') ? 'active' : '' }}">
                        <i class="nav-icon far fa fa-list"></i>
                        <p>Categories</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="/admin/post" class="nav-link {{ request()->is('admin/post') ? 'active' : '' }}">
                        <i class="nav-icon far fa fa-book"></i>
                        <p>Posts</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="/admin/client" class="nav-link {{ request()->is('admin/client') ? 'active' : '' }}">
                        <i class="nav-icon fa fa-users"></i>
                        <p>Clients</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="/admin/contact" class="nav-link {{ request()->is('admin/contact') ? 'active' : '' }}">
                        <i class="nav-icon far fa fa-info-circle"></i>
                        <p>Contacts</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="/admin/setting" class="nav-link {{ request()->is('admin/setting') ? 'active' : '' }}">
                        <i class="nav-icon fa fa-cogs"></i>
                        <p>Settings</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="/admin/users" class="nav-link {{ request()->is('admin/users') ? 'active' : '' }}">
                        <i class="nav-icon fa fa-user"></i>
                        <p>Users</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="/admin/roles" class="nav-link {{ request()->is('admin/roles') ? 'active' : '' }}">
                        <i class="nav-icon fa fa-id-card"></i>
                        <p>Roles</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="/admin/permissions" class="nav-link {{ request()->is('admin/permissions') ? 'active' : '' }}">
                        <i class="nav-icon fa fa-check"></i>
                        <p>Permissions</p>
                    </a>
                </li>

                
                <!-- Add more nav-items as needed -->
            </ul>
        </nav>

    </div>
</aside>
