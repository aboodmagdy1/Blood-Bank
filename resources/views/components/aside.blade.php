<aside class="main-sidebar sidebar-dark-primary elevation-4 h-max">
    <!-- Brand Logo -->
    <a href="/dashboard" class="brand-link">
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
                    <a href="/governorate" class="nav-link {{ request()->is('governorate') ? 'active' : '' }}">
                        <i class="nav-icon fa fa-globe"></i>
                        <p>Governorates</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="/city" class="nav-link {{ request()->is('city') ? 'active' : '' }}">
                        <i class="nav-icon far fa fa-flag"></i>
                        <p>Cities</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="/blood-type" class="nav-link {{ request()->is('blood-type') ? 'active' : '' }}">
                        <i class="nav-icon far fa fa-tint"></i>
                        <p>Blood Types</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="/donation-request" class="nav-link {{ request()->is('donation-request') ? 'active' : '' }}">
                        <i class="nav-icon far fa fa-medkit "></i>
                        <p>Donation Requests</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="/category" class="nav-link {{ request()->is('category') ? 'active' : '' }}">
                        <i class="nav-icon far fa fa-list"></i>
                        <p>Categories</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="/post" class="nav-link {{ request()->is('post') ? 'active' : '' }}">
                        <i class="nav-icon far fa fa-book"></i>
                        <p>Posts</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="/client" class="nav-link {{ request()->is('client') ? 'active' : '' }}">
                        <i class="nav-icon fa fa-users"></i>
                        <p>Clients</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="/contact" class="nav-link {{ request()->is('contact') ? 'active' : '' }}">
                        <i class="nav-icon far fa fa-info-circle"></i>
                        <p>Contacts</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="/setting" class="nav-link {{ request()->is('setting') ? 'active' : '' }}">
                        <i class="nav-icon fa fa-cogs"></i>
                        <p>Settings</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="/users" class="nav-link {{ request()->is('user') ? 'active' : '' }}">
                        <i class="nav-icon fa fa-user"></i>
                        <p>Users</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="/roles" class="nav-link {{ request()->is('user') ? 'active' : '' }}">
                        <i class="nav-icon fa fa-id-card"></i>
                        <p>Roles</p>
                    </a>
                </li>

                {{-- <li class="nav-item">
                    <a href="/user" class="nav-link {{ request()->is('user') ? 'active' : '' }}">
                        <i class="nav-icon fa fa-user"></i>
                        <p>Users</p>
                    </a>
                </li> --}}

                
                <!-- Add more nav-items as needed -->
            </ul>
        </nav>

    </div>
</aside>
