<div class="flapt-sidemenu-wrapper">
    <!-- Desktop Logo -->
    <div class="flapt-logo">
        <a href="#">
            <span>Alharam</span>
        </a>
    </div>

    <!-- Side Nav -->
    <div class="flapt-sidenav" id="flaptSideNav">
        <!-- Side Menu Area -->
        <div class="side-menu-area">
            <!-- Sidebar Menu -->
            <nav>
                <ul class="sidebar-menu" data-widget="tree">
                    <li class="menu-header-title">Dashboard</li>
                    <li class="treeview">
                        <a class="menu-active" href="{{ route('admin.dashboard') }}">
                            <i class='bx bx-home-heart'></i>
                            <span>Dashboard</span>
                        </a>
                    </li>

                    <li class="menu-header-title">Administration</li>
                    <li class="treeview">
                        <a href="javascript:void(0)">
                            <i class="bx bx-user-circle"></i>
                            <span>Administration</span>
                            <i class="fa fa-angle-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="{{ route('admin.users.index') }}">Users</a></li>
                            <li><a href="{{ route('admin.roles.index') }}">Roles</a></li>
                            @can('list projects')
                                <li><a href="{{ route('projects.index') }}">Projects</a></li>
                            @endcan
                            @can('list vendors')
                                <li><a href="{{ route('vendor-suppliers.index') }}">Vendors &amp; Suppliers</a></li>
                            @endcan
                        </ul>
                    </li>

                    <li class="menu-header-title">Management</li>
                    <li class="treeview">
                        <a href="javascript:void(0)">
                            <i class="bx bx-briefcase-alt"></i>
                            <span>Management</span>
                            <i class="fa fa-angle-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            <li>
                                <a href="{{ route('admin.purchases.index') }}">
                                    Stock Entry
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.sales.index') }}">
                                    Sales
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.labor-costs.index') }}">
                                    Labor Cost
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.daily-expenses.index') }}">
                                    Daily Expenses
                                </a>
                            </li>
                            {{-- Other modules (etc.) can be added here with @can checks --}}
                        </ul>
                    </li>

                    <li class="menu-header-title">Settings</li>
                    <li>
                        <a href="{{ route('admin.wood-types.index') }}">
                            <i class="bx bx-tree"></i>
                            <span>Wood Types</span>
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.vendors.index') }}">
                            <i class="bx bx-store-alt"></i>
                            <span>Vendors</span>
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.expense-types.index') }}">
                            <i class="bx bx-list-check"></i>
                            <span>Expense Types</span>
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>

