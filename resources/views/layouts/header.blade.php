<!--Main Navigation-->
<header>
    <div style="display: none;">{{ $categories = App\Models\Category::all() }}</div>
    @if (Auth::check())
        @if (auth()->user()->role_as == '1')
            <!-- Sidebar -->
            <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

                <!-- Sidebar - Brand -->
                <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('admin') }}">
                    <div class="sidebar-brand-icon">
                        <i class="fa fa-chevron-up" aria-hidden="true"></i>
                    </div>
                    <div class="sidebar-brand-text mx-3">Ecommerce Admin Panel</div>
                </a>

                <!-- Divider -->
                <hr class="sidebar-divider my-0">

                <!-- Nav Item - Dashboard -->
                <li class="nav-item active">
                    <a class="nav-link" href="{{ url('admin') }}">
                        <i class="fa fa-tachometer" aria-hidden="true"></i>
                        <span>Dashboard</span></a>
                </li>

                <!-- Divider -->
                <hr class="sidebar-divider">

                <!-- Heading -->
                <div class="sidebar-heading">
                    Users
                </div>

                <!-- Nav Item - Pages Collapse Menu -->
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUser"
                        aria-expanded="true" aria-controls="collapseUser">
                        <i class="fa fa-user-o" aria-hidden="true"></i>
                        <span>Users</span>
                    </a>
                    <div id="collapseUser" class="collapse" aria-labelledby="headingTwo"
                        data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item" href="{{ url('admin/addUsers') }}">Add Users</a>
                            <a class="collapse-item" href="{{ url('admin/viewUsers') }}">View Users</a>
                        </div>
                    </div>
                </li>

                <!-- Divider -->
                <hr class="sidebar-divider">

                <!-- Heading -->
                <div class="sidebar-heading">
                    Stocks
                </div>

                <!-- Nav Item - Pages Collapse Menu -->
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOne"
                        aria-expanded="true" aria-controls="collapseOne">
                        <i class="fa fa-shopping-basket" aria-hidden="true"></i>
                        <span>Categories</span>
                    </a>
                    <div id="collapseOne" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Categories list:</h6>
                            <a class="collapse-item" href="{{ url('admin/addCategories') }}">Add Categories</a>
                            <a class="collapse-item" href="{{ url('admin/viewCategories') }}">View Categories</a>
                        </div>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link collapsed" href="" data-toggle="collapse" data-target="#collapseTwo"
                        aria-expanded="true" aria-controls="collapseTwo">
                        <i class="fa fa-shopping-bag" aria-hidden="true"></i>
                        <span>Products</span>
                    </a>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Product list:</h6>
                            <a class="collapse-item" href="{{ url('admin/addProducts') }}">Add Products</a>
                            <a class="collapse-item" href="{{ url('admin/viewProducts') }}">View Products</a>
                        </div>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link collapsed" href="" data-toggle="collapse" data-target="#collapseThree"
                        aria-expanded="true" aria-controls="collapseThree">
                        <i class="fa fa-cart-arrow-down" aria-hidden="true"></i>
                        <span>Items</span>
                    </a>
                    <div id="collapseThree" class="collapse" aria-labelledby="headingTwo"
                        data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Item list:</h6>
                            <a class="collapse-item" href="{{ url('admin/addItems') }}">Add Items</a>
                            <a class="collapse-item" href="{{ url('admin/viewItems') }}">View Items</a>
                            <a class="collapse-item" href="{{ url('admin/itemsOnCart') }}">Items on Customers Cart</a>
                        </div>
                    </div>
                </li>

                <!-- Divider -->
                <hr class="sidebar-divider">

                <!-- Heading -->
                <div class="sidebar-heading">
                    Orders
                </div>

                <!-- Nav Item - Pages Collapse Menu -->
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOrders"
                        aria-expanded="true" aria-controls="collapseOrders">
                        <i class="fa fa-cubes" aria-hidden="true"></i>
                        <span>Orders</span>
                    </a>
                    <div id="collapseOrders" class="collapse" aria-labelledby="headingTwo"
                        data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item" href="{{ url('admin/viewOrders') }}">View Orders</a>
                            <a class="collapse-item" href="{{ url('admin/ordersInProgress') }}">Orders in
                                Progress</a>
                            <a class="collapse-item" href="{{ url('admin/ordersCompleted') }}">Orders Completed</a>
                        </div>
                    </div>
                </li>

            </ul>
            <!-- End of Sidebar -->

            <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column">

                <!-- Main Content -->
                <div id="content">

                    <!-- Topbar -->
                    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                        <!-- Sidebar Toggle (Topbar) -->
                        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                            <i class="fa fa-bars"></i>
                        </button>

                        <!-- Topbar Search -->
                        <form action="{{ url('/') }}"
                            class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                            <div class="input-group">
                                <input type="text" class="form-control bg-light border-0 small"
                                    placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit">
                                        <i class="fa fa-search" aria-hidden="true"></i>
                                    </button>
                                </div>
                            </div>
                        </form>

                        <!-- Topbar Navbar -->
                        <ul class="navbar-nav ml-auto">

                            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                            <li class="nav-item dropdown no-arrow d-sm-none">
                                <a class="nav-link dropdown-toggle" href="#" id="searchDropdown"
                                    role="button" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                    <i class="fas fa-search fa-fw"></i>
                                </a>
                                <!-- Dropdown - Messages -->
                                <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                    aria-labelledby="searchDropdown">
                                    <form class="form-inline mr-auto w-100 navbar-search">
                                        <div class="input-group">
                                            <input type="text" class="form-control bg-light border-0 small"
                                                placeholder="Search for..." aria-label="Search"
                                                aria-describedby="basic-addon2">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary" type="button">
                                                    <i class="fas fa-search fa-sm"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </li>

                            <div class="topbar-divider d-none d-sm-block"></div>

                            <!-- Nav Item - User Information -->
                            <li class="nav-item dropdown no-arrow">
                                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="mr-2 d-none d-lg-inline text-gray-600 small">Hi
                                        {{ auth()->user()->name }}</span>
                                    {{-- <img class="img-profile rounded-circle" src="img/undraw_profile.svg"> --}}
                                    <i class="fa fa-user-circle-o" aria-hidden="true"></i>
                                </a>
                                <!-- Dropdown - User Information -->
                                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                    aria-labelledby="userDropdown">
                                    <a class="dropdown-item" href="{{ url('myProfile/' . auth()->user()->id) }}">
                                        <i class="fa fa-address-card-o" aria-hidden="true"></i>
                                        My Profile
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item text-danger" href="{{ url('logout') }}">
                                        <i class="fa fa-sign-out" aria-hidden="true"></i>
                                        Logout
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </nav>
                @else
                    <nav class="navbar navbar-expand-lg navbar-light bg-primary">
                        <div class="container-fluid">
                            <a class="navbar-brand" href="#" style="color:aliceblue">Ecommerce</a>
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse navbar-right" id="navbarSupportedContent">
                                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                    <li class="nav-item">
                                        <a class="nav-link active" aria-current="page"
                                            href="{{ url('/') }}" style="color:aliceblue">Home</a>
                                    </li>
                                    @if (Auth::check())
                                        <li class="nav-item dropdown">
                                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown"
                                                role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color:aliceblue">
                                                hi {{ auth()->user()->name }}
                                            </a>
                                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                                <li><a class="dropdown-item text-info"
                                                        href="{{ url('myProfile/' . auth()->user()->id) }}" style="color:aliceblue">My
                                                        profile</a></li>
                                                    <li><a class="dropdown-item text-primary" href="{{ url('myOrders/'.auth()->user()->id) }}" style="color:aliceblue">My Orders</a>
                                                    </li>
                                                <li><a href="{{ url('logout') }}" class="dropdown-item text-danger"
                                                        style="text-decoration:none;" style="color:aliceblue">Logout</a></li>
                                            </ul>
                                        </li>
                                    @else
                                        <li class="nav-item dropdown">
                                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown"
                                                role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                Login
                                            </a>
                                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                                <li><a class="dropdown-item" href="{{ url('login') }}" style="color:aliceblue">Log In</a>
                                                </li>
                                                <li><a class="dropdown-item" href="{{ url('register') }}" style="color:aliceblue">Register
                                                        New
                                                        User</a>
                                                </li>
                                            </ul>
                                        </li>
                                    @endif
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown"
                                            role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color:aliceblue">
                                            Categories
                                        </a>
                                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                            @foreach ($categories as $category)
                                                <li><a class="dropdown-item"
                                                        href="#">{{ $category->category_name }}</a></li>
                                            @endforeach
                                        </ul>
                                    </li>
                                    <li class="nav-item">
                                        @php
                                            $carts = App\Models\Cart::all();
                                            $userId = auth()->user()->id;
                                            $cartCount = 0;
                                            foreach ($carts as $cart) {
                                                if ($userId == $cart->user_id) {
                                                    $cartCount += 1;
                                                }
                                            }
                                        @endphp
                                        <a class="nav-link" id="cart"
                                            href="{{ url('viewCart') }}" style="color:aliceblue"><i class="fa fa-shopping-cart" aria-hidden="true"></i>Cart({{ $cartCount }})</a>
                                    </li>
                                </ul>
                                <form class="d-flex">

                                    <input class="form-control me-2" type="search" placeholder="Search"
                                        aria-label="Search">
                                    <button class="btn btn-outline-light" type="submit" style="color:aliceblue">Search</button>
                                </form>
                            </div>
                        </div>
                    </nav>
        @endif
        <!-- End of Topbar -->
    @else
        <nav class="navbar navbar-expand-lg navbar-light bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand text-light" href="#">Ecommerce</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse navbar-right" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active text-light" aria-current="page" href="{{ url('/') }}">Home</a>
                        </li>
                        @if (Auth::check())
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle text-light" href="#" id="navbarDropdown"
                                    role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    hi {{ auth()->user()->name }}
                                </a>
                                <ul class="dropdown-menu text-light" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item"
                                            href="{{ url('myProfile/' . auth()->user()->id) }}">My
                                            profile</a></li>
                                    @if (auth()->user()->role_as == '1')
                                        <li><a class="dropdown-item" href="{{ url('admin') }}">Admin
                                                Panel</a>
                                        </li>
                                    @endif
                                    <li><a href="{{ url('logout') }}" class="btn btn-link text-danger"
                                            style="text-decoration:none;">Logout</a></li>
                                </ul>
                            </li>
                        @else
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle text-light" href="#" id="navbarDropdown"
                                    role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Login
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="{{ url('login') }}">Log In</a>
                                    </li>
                                    <li><a class="dropdown-item" href="{{ url('register') }}">Register
                                            New
                                            User</a>
                                    </li>
                                </ul>
                            </li>
                        @endif
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-light" href="#" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Categories
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                @foreach ($categories as $category)
                                    <li><a class="dropdown-item" href="#">{{ $category->category_name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light" id="cart" href="{{ url('viewCart') }}"><i class="fa fa-shopping-cart" aria-hidden="true"></i>Cart(0)</a>
                        </li>
                    </ul>
                    <form action="/" class="d-flex" method="GET">
                        @csrf
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search">
                        <input class="btn btn-outline-light text-light" type="submit" value="Search">
                    </form>
                </div>
            </div>
        </nav>
    @endif
</header>
