<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Title -->
    <title>@yield('title', 'Laxom- Bootstrap Admin Template')</title>

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('img/core-img/favicon.ico') }}">

    <!-- Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/animate.css') }}">

    <!-- Master Stylesheet [If you remove this CSS file, your file will be broken undoubtedly.] -->
    <link rel="stylesheet" href="{{ asset('style.css') }}">

    @stack('styles')
</head>

<body>
    <!-- Preloader -->
    <div id="preloader">
        <div class="preloader-book">
            <div class="inner">
                <div class="left"></div>
                <div class="middle"></div>
                <div class="right"></div>
            </div>
            <ul>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
            </ul>
        </div>
    </div>
    <!-- /Preloader -->

    <!-- Choose Layout -->
    <div class="choose-layout-area">
        <div class="setting-trigger-icon" id="settingTrigger">
            <i class="ti-settings"></i>
        </div>
        <div class="choose-layout" id="chooseLayout">
            <div class="quick-setting-tab">
                <div class="widgets-todo-list-area">
                    <h4 class="todo-title">Todo List:</h4>
                    <form id="form-add-todo" class="form-add-todo">
                        <input type="text" id="new-todo-item" class="new-todo-item form-control" name="todo"
                            placeholder="Add New">
                        <input type="submit" id="add-todo-item" class="add-todo-item" value="+">
                    </form>

                    <form id="form-todo-list">
                        <ul id="flaptToDo-list" class="todo-list">
                            <li><label class="ckbox"><input type="checkbox" name="todo-item-done"
                                        class="todo-item-done" value="test"><span></span></label>Go to Market
                                <i class="todo-item-delete ti-close"></i></li>

                            <li><label class="ckbox"><input type="checkbox" name="todo-item-done"
                                        class="todo-item-done" value="hello"><span></span></label>Meeting with AD
                                <i class="todo-item-delete ti-close"></i></li>

                            <li><label class="ckbox"><input type="checkbox" name="todo-item-done"
                                        class="todo-item-done" value="hello"><span></span></label>Check Mail
                                <i class="todo-item-delete ti-close"></i></li>

                            <li><label class="ckbox"><input type="checkbox" name="todo-item-done"
                                        class="todo-item-done" value="hello"><span></span></label>Work for Theme
                                <i class="todo-item-delete ti-close"></i></li>

                            <li><label class="ckbox"><input type="checkbox" name="todo-item-done"
                                        class="todo-item-done" value="hello"><span></span></label>Create a Plugin
                                <i class="todo-item-delete ti-close"></i></li>

                            <li><label class="ckbox"><input type="checkbox" name="todo-item-done"
                                        class="todo-item-done" value="hello"><span></span></label>Fixed Template Issues
                                <i class="todo-item-delete ti-close"></i></li>
                        </ul>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- ======================================
    ******* Page Wrapper Area Start **********
    ======================================= -->
    <div class="flapt-page-wrapper">
        <!-- Sidemenu Area -->
        <div class="flapt-sidemenu-wrapper">
            <!-- Desktop Logo -->
            <div class="flapt-logo">
                <a href="#">
                    <img class="desktop-logo" src="{{ asset('img/core-img/logo.png') }}" alt="Desktop Logo">
                    <img class="small-logo" src="{{ asset('img/core-img/small-logo.png') }}" alt="Mobile Logo">
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

                            <li class="menu-header-title">Management</li>
                            <li>
                                <a href="{{ route('admin.users.index') }}">
                                    <i class="bx bx-user"></i>
                                    <span>Users</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.roles.index') }}">
                                    <i class="bx bx-shield"></i>
                                    <span>Roles</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.purchases.index') }}">
                                    <i class="bx bx-cart-alt"></i>
                                    <span>Stock Entry</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>

        <!-- Page Content -->
        <div class="flapt-page-content">
            <!-- Top Header Area -->
            <header class="top-header-area d-flex align-items-center justify-content-between">
                <div class="left-side-content-area d-flex align-items-center">
                    <!-- Mobile Logo -->
                    <div class="mobile-logo">
                        <a href="#"><img src="{{ asset('img/core-img/small-logo.png') }}" alt="Mobile Logo"></a>
                    </div>

                    <!-- Triggers -->
                    <div class="flapt-triggers">
                        <div class="menu-collasped" id="menuCollasped">
                            <i class='bx bx-grid-alt'></i>
                        </div>
                        <div class="mobile-menu-open" id="mobileMenuOpen">
                            <i class='bx bx-grid-alt'></i>
                        </div>
                    </div>

                    <!-- Left Side Nav -->
                    <ul class="left-side-navbar d-flex align-items-center">
                        <li class="hide-phone app-search">
                            <input type="text" class="form-control" placeholder="Search...">
                            <span class="bx bx-search-alt"></span>
                        </li>
                    </ul>
                </div>

                <div class="right-side-navbar d-flex align-items-center justify-content-end">
                    <!-- Mobile Trigger -->
                    <div class="right-side-trigger" id="rightSideTrigger">
                        <i class='bx bx-menu-alt-right'></i>
                    </div>

                    <!-- Top Bar Nav -->
                    <ul class="right-side-content d-flex align-items-center">
                        <li class="nav-item dropdown">
                            <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false"><span><i
                                        class='bx bx-world'></i></span></button>
                            <div class="dropdown-menu language-dropdown dropdown-menu-right">
                                <div class="user-profile-area">
                                    <a href="#" class="dropdown-item mb-15"><img
                                            src="{{ asset('img/core-img/l5.jpg') }}" alt="Image">
                                        <span>USA</span></a>
                                    <a href="#" class="dropdown-item mb-15"><img
                                            src="{{ asset('img/core-img/l2.jpg') }}" alt="Image">
                                        <span>German</span></a>
                                    <a href="#" class="dropdown-item mb-15"><img
                                            src="{{ asset('img/core-img/l3.jpg') }}" alt="Image">
                                        <span>Italian</span></a>
                                    <a href="#" class="dropdown-item"><img src="{{ asset('img/core-img/l4.jpg') }}"
                                            alt="Image">
                                        <span>Russian</span></a>
                                </div>
                            </div>
                        </li>

                        <li class="nav-item dropdown">
                            <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false"><i class='bx bx-envelope'></i></button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <!-- Message Area -->
                                <div class="top-message-area">
                                    <!-- Heading -->
                                    <div class="message-heading">
                                        <div class="heading-title">
                                            <h6 class="mb-0">All Messages</h6>
                                        </div>
                                        <span>10</span>
                                    </div>

                                    <div class="message-box" id="messageBox">
                                        <a href="#" class="dropdown-item">
                                            <img src="{{ asset('img/bg-img/thumb-1.jpg') }}" alt="">
                                            <span>Bonbon macaroon jelly beans gummi bears jelly lollipop apple</span>
                                        </a>

                                        <a href="#" class="dropdown-item">
                                            <img src="{{ asset('img/bg-img/thumb-2.jpg') }}" alt="">
                                            <span>sesame snaps pudding cupcake candy canes topping</span>
                                        </a>

                                        <a href="#" class="dropdown-item">
                                            <img src="{{ asset('img/bg-img/thumb-3.jpg') }}" alt="">
                                            <span>Tootsie roll sesame snaps lemon drops candy canes</span>
                                        </a>

                                        <a href="#" class="dropdown-item">
                                            <img src="{{ asset('img/bg-img/thumb-4.jpg') }}" alt="">
                                            <span>jelly beans lollipop marshmallow brownie gummi bears muffin</span>
                                        </a>

                                        <a href="#" class="dropdown-item">
                                            <img src="{{ asset('img/bg-img/thumb-5.jpg') }}" alt="">
                                            <span>cheesecake toffee apple pie chocolate bar biscuit</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </li>

                        <li class="nav-item dropdown">
                            <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false"><i class='bx bx-bell'></i> <span
                                    class="active-status"></span></button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <!-- Top Notifications Area -->
                                <div class="top-notifications-area">
                                    <!-- Heading -->
                                    <div class="notifications-heading">
                                        <div class="heading-title">
                                            <h6 class="mb-0">Notifications</h6>
                                        </div>
                                        <span>11</span>
                                    </div>

                                    <div class="notifications-box" id="notificationsBox">
                                        <a href="#" class="dropdown-item">
                                            <i class='bx bx-shopping-bag'></i>
                                            <div>
                                                <span>Your order is placed</span>
                                                <p class="mb-0 font-12">Consectetur adipisicing elit. Ipsa, porro!</p>
                                            </div>
                                        </a>

                                        <a href="#" class="dropdown-item">
                                            <i class='bx bx-wallet-alt'></i>
                                            <div>
                                                <span>Haslina Obeta</span>
                                                <p class="mb-0 font-12">Consectetur adipisicing elit. Ipsa, porro!</p>
                                            </div>
                                        </a>

                                        <a href="#" class="dropdown-item">
                                            <i class='bx bx-dollar-circle'></i>
                                            <div>
                                                <span>Your order is Dollar</span>
                                                <p class="mb-0 font-12">Consectetur adipisicing elit. Ipsa, porro!</p>
                                            </div>
                                        </a>

                                        <a href="#" class="dropdown-item">
                                            <i class='bx bx-border-all'></i>
                                            <div>
                                                <span>Your order is placed</span>
                                                <p class="mb-0 font-12">Consectetur adipisicing elit. Ipsa, porro!</p>
                                            </div>
                                        </a>
                                        <a href="#" class="dropdown-item">
                                            <i class='bx bx-wallet-alt'></i>
                                            <div>
                                                <span>Haslina Obeta</span>
                                                <p class="mb-0 font-12">Consectetur adipisicing elit. Ipsa, porro!</p>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </li>

                        <li class="nav-item dropdown">
                            <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <img src="{{ asset('img/bg-img/person_1.jpg') }}" alt="">
                            </button>
                            <div class="dropdown-menu profile dropdown-menu-right">
                                <!-- User Profile Area -->
                                <div class="user-profile-area">
                                    <a href="#" class="dropdown-item"><i class="bx bx-user font-15"
                                            aria-hidden="true"></i> My profile</a>
                                    <a href="#" class="dropdown-item"><i class="bx bx-wallet font-15"
                                            aria-hidden="true"></i> My wallet</a>
                                    <a href="#" class="dropdown-item"><i class="bx bx-wrench font-15"
                                            aria-hidden="true"></i> settings</a>
                                    <a href="#" class="dropdown-item"><i class="bx bx-power-off font-15"
                                            aria-hidden="true"></i> Sign-out</a>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </header>

            <!-- Main Content Area -->
            <div class="main-content">
                <div class="content-wraper-area">
                    @yield('content')
                </div>
            </div>

            <!-- Footer Area -->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <footer
                            class="footer-area d-sm-flex justify-content-center align-items-center justify-content-between">
                            <div class="copywrite-text">
                                <p class="font-13">Developed by &copy; <a href="#">Theme-life</a></p>
                            </div>
                            <div class="fotter-icon text-center">
                                <p class="mb-0 font-13">2024 &copy; Laxom Admin</p>
                            </div>
                        </footer>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ======================================
    ********* Page Wrapper Area End ***********
    ======================================= -->

    <!-- Must needed plugins to run this template -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/default-assets/setting.js') }}"></script>
    <script src="{{ asset('js/default-assets/scrool-bar.js') }}"></script>
    <script src="{{ asset('js/todo-list.js') }}"></script>

    <!-- Active JS -->
    <script src="{{ asset('js/default-assets/active.js') }}"></script>

    @stack('scripts')
</body>

</html>

