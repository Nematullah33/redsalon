<nav class="pcoded-navbar">
    <div class="sidebar_toggle"><a href="#"><i class="icon-close icons"></i></a></div>
    <div class="pcoded-inner-navbar main-menu">
        <div class="">
            <div class="main-menu-header">
            <img class="img-80 img-radius" src="{{asset('img')}}/{{session('sess_img_photo')}}" alt="User-Profile-Image">
                <div class="user-details">
                    <span id="more-details">{{session('sess_user_name')}}<i class="fa fa-caret-down"></i></span>
                </div>
            </div>
            <div class="main-menu-content">
                <ul>
                    <li class="more-details">
                        {{-- <a href="user-profile.html"><i class="ti-user"></i>View Profile</a> --}}
                        <a href="{{url('logout')}}"><i class="ti-layout-sidebar-left"></i>Logout</a>
                    </li>
                </ul>
            </div>
        </div>
        {{-- <div class="p-15 p-b-0">
            <form class="form-material">
                <div class="form-group form-primary">
                    <input type="text" name="footer-email" class="form-control">
                    <span class="form-bar"></span>
                    <label class="float-label"><i class="fa fa-search m-r-10"></i>Search Friend</label>
                </div>
            </form>
        </div> --}}
        <ul class="pcoded-item pcoded-left-item">
            <li class="active">
                <a href="{{url('/home')}}" class="waves-effect waves-dark">
                    <span class="pcoded-micon"><i class="ti-home"></i><b>D</b></span>
                    <span class="pcoded-mtext">Dashboard</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>
        </ul>
        
        @foreach($menumaps as $menu)
           
            @if($menu->menu_name == 'Bookings')
                @include('layout.erp.menus.booking_menu')
            @endif
            @if($menu->menu_name == 'Sales')
            @include('layout.erp.menus.order_menu')
            @endif
            @if($menu->menu_name == 'Customers')
                @include('layout.erp.menus.buyer_menu')
            @endif
            @if($menu->menu_name == 'Suppliers')
            @include('layout.erp.menus.supplier_menu')
            @endif
            @if($menu->menu_name == 'Services')
            @include('layout.erp.menus.service_menu')
            @endif
            @if($menu->menu_name == 'Products')
            @include('layout.erp.menus.product_menu')
            @endif

            @if($menu->menu_name == 'Expense')
            @include('layout.erp.menus.expense_menu')
            @endif
            @if($menu->menu_name == 'Categories')
            @include('layout.erp.menus.category_menu')
            @endif
            @if($menu->menu_name == 'Stocks')
                @include('layout.erp.menus.stock_menu')
            @endif
            @if($menu->menu_name == 'Purchases')
                @include('layout.erp.menus.purchase_menu')
            @endif
            @if($menu->menu_name == 'Payments')
                @include('layout.erp.menus.payment_menu')
            @endif
            @if($menu->menu_name == 'Users')
                @include('layout.erp.menus.user_menu')
            @endif
            @if($menu->menu_name == 'Reports')
                @include('layout.erp.menus.report_menu')
            @endif
        @endforeach
       
    </div>
</nav>